<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;

class ClientController extends Controller
{
    public function index() {
        return view('client.home');
    }

    public function introduce() {
        return view('client.introduce');
    }

    public function project() {
        return view('client.project');
    }

    public function article() {
        return view('client.article');
    }

    public function productDetail($id) {
        return view('client.product-detail');
    }

    public function wishlist() {
        return view('client.article');
    }

    public function productCategory($id) {
        $products = Product::where('category_id','=',$id)->orderBy('id','DESC')->paginate(12, ['*'],'product');
        $category = Category::find($id);

        return view('client.product-category',
            [
                'products' => $products,
                'title' => $category->name
            ]
        );
    }
}
