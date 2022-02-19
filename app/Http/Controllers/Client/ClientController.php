<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\CategoryArticle;
use App\Models\Contact;
use App\Models\Wishlist;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\Bill;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ClientController extends Controller
{
    public function index() {
        $leftArticle = Article::take(2)->orderBy('view', 'DESC')->orderBy('id','DESC')->get();
        foreach($leftArticle as $item) {
            $ids[] = $item['id'];
        }
        $rightArticle = Article::whereNotIn('id', $ids)->take(4)->orderBy('view', 'DESC')->orderBy('id','DESC')->get();
        return view('client.home', compact('leftArticle', 'rightArticle'));
    }

    public function introduce() {
        return view('client.introduce');
    }

    public function project() {
        $projects = Project::with("image")->orderBy('view', 'DESC')->orderBy('id','DESC')->paginate(12, ['*'],'project');
        return view('client.project', compact('projects'));
    }

    public function article() {
        $categoryArticles = CategoryArticle::all();
        return view('client.article', compact('categoryArticles'));
    }

    public function productDetail($id) {
        $wishlists = [];
        if (Auth::check()) {
            $wishlists = Wishlist::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
        }
        $product = Product::with("image")->join('categories','products.category_id','=','categories.id')->where('products.id', $id)->select(['products.*', 'categories.name AS category_name'])->first();
        $relationProduct = Product::inRandomOrder()->where('id','<>',$id)->where('category_id',$product->category_id)->orderBy('view', 'DESC')->orderBy('id','DESC')->limit(12)->get();
        // increment product view
        Event::dispatch('product.view', $product);
        return view('client.product-detail', compact('product', 'relationProduct', 'wishlists'));
    }

    public function wishlist() {
        $wishlists = Wishlist::where('user_id',Auth::user()->id)->get();
        return view('client.wishlist', compact('wishlists'));
    }

    public function productCategory($id) {
        $products = Product::where('category_id','=',$id)->where('status',1)->orderBy('view', 'DESC')->orderBy('id','DESC')->paginate(12, ['*'],'product');
        $category = Category::find($id);

        return view('client.product-category',
            [
                'products' => $products,
                'title' => $category->name
            ]
        );
    }

    public function articleDetail($id) {
        $article = Article::join('category_articles','articles.category_article_id','=','category_articles.id')->where('articles.id', $id)->select(['articles.*', 'category_articles.name AS category_name'])->first();
        $relationArticle = Article::inRandomOrder()->where('id','<>',$id)->orderBy('view', 'DESC')->orderBy('id','DESC')->limit(12)->get();
        // increment article view
        Event::dispatch('article.view', $article);
        return view('client.article-detail', compact('article', 'relationArticle'));
    }

    public function contact() 
    {
        return view('client.contact');
    }

    public function postContact(Request $request) 
    {
        $data = $request->all();
        Contact::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'description' => $data['description']
        ]);
        Alert::success('Success', 'Gửi thành công');
        return view('client.contact');
    }

    public function addWishlist(Request $request) {
        Wishlist::create([
            'product_id' => $request->id,
            'user_id' => Auth::user()->id
        ]);
        
        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteWishlist($id) {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect()->back();
    }

    public function contractWishlist($id) {
        return view('client.contract', compact('id'));
    }

    public function postSearch(Request $request) {
        $builder = new Product;
        $data = $request->all();

        // Filter category
        if (!is_null($data['category'])) {
            $builder = $builder->where('category_id', $data['category']);
        }

        // Filter price
        if (!is_null($data['price'])) {
            if ($data['price'] == 0) {
                $builder = $builder->where('room_price','<',3 * pow(10,6));
            } elseif ($data['price'] == 1) {
                $builder = $builder->whereBetween('room_price',[3 * pow(10,6) + pow(10,5), 4 * pow(10,6)]);
            } elseif ($data['price'] == 2) {
                $builder = $builder->whereBetween('room_price',[4 * pow(10,6) + pow(10,5), 4 * pow(10,6) + 5 * pow(10,5)]);
            } elseif ($data['price'] == 3) {
                $builder = $builder->whereBetween('room_price',[4 * pow(10,6) + 6 * pow(10,5), 5 * pow(10,6)]);
            } elseif ($data['price'] == 4) {
                $builder = $builder->whereBetween('room_price',[5 * pow(10,6) + pow(10,5), 8 * pow(10,6)]);
            } else {
                $builder = $builder->where('room_price','>',8 * pow(10,6));
            }
        }

        // Filter area
        if (!is_null($data['area'])) {
            if ($data['area'] == 0) {
                $builder = $builder->where('area','<=',30);
            } elseif ($data['area'] == 1) {
                $builder = $builder->whereBetween('area',[30, 50]);
            } elseif ($data['area'] == 2) {
                $builder = $builder->where('area','>',50);
            }
        }

        // Filter city
        if (!is_null($data['city_id'])) {
            if ($data['city_id']) {
                $builder = $builder->where('city_id', $data['city_id']);
            }
        }

        // Filter district
        if (!is_null($data['district_id'])) {
            if ($data['district_id']) {
                $builder = $builder->where('district_id', $data['district_id']);
            }
        }

        // Filter ward
        if (!is_null($data['ward_id'])) {
            if ($data['ward_id']) {
                $builder = $builder->where('ward_id', $data['ward_id']);
            }
        }

        return view('client.search', ['products' => $builder->where('status',1)->orderBy('view', 'DESC')->orderBy('id','DESC')->paginate(12, ['*'],'product')]);
    }

    public function ajaxDistrict(Request $request)
    {
        $districts = District::where('matp', $request->city_id)->get();
        return response()->json([
            'status' => 200,
            'data' => view('client.includes.district', compact('districts'))->render()
        ]);
    }

    public function ajaxWard(Request $request)
    {
        $wards = Ward::where('maqh', $request->district_id)->get();
        return response()->json([
            'status' => 200,
            'data' => view('client.includes.ward', compact('wards'))->render()
        ]);
    }

    public function postContract($id, Request $request)
    {
        $data = $request->all();
        Order::create([
            'fullname' => $data['fullname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'product_id' => Wishlist::find($id)->product_id,
            'staff_id' => Auth::user()->id,
            'description' => $data['description']
        ]);
        Alert::success('Success', 'Gửi thành công');
        return redirect()->route('home');
    }

    public function bill() {
        $bills = Bill::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('client.bill', compact('bills'));
    }

    public function projectDetail($id)
    {
        $project = Project::with("image")->first();
        $relationProject = Project::inRandomOrder()->where('id','<>',$id)->orderBy('view', 'DESC')->orderBy('id','DESC')->limit(12)->get();
        // increment project view
        Event::dispatch('project.view', $project);
        return view('client.project-detail', compact('project', 'relationProject'));
    }

    public function order()
    {
        $orders = Order::get();
        return view('client.order', compact('orders'));
    }
}
