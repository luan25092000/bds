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
Use Alert;

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
        return view('client.project');
    }

    public function article() {
        $categoryArticles = CategoryArticle::all();
        return view('client.article', compact('categoryArticles'));
    }

    public function productDetail($id) {
        $product = Product::with("image")->join('categories','products.category_id','=','categories.id')->where('products.id', $id)->select(['products.*', 'categories.name AS category_name'])->first();
        $relationProduct = Product::inRandomOrder()->where('id','<>',$id)->orderBy('view', 'DESC')->orderBy('id','DESC')->limit(12)->get();

        return view('client.product-detail', compact('product', 'relationProduct'));
    }

    public function wishlist() {
        return view('client.article');
    }

    public function productCategory($id) {
        $products = Product::where('category_id','=',$id)->orderBy('view', 'DESC')->orderBy('id','DESC')->paginate(12, ['*'],'product');
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
}
