<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\CategoryArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::join('category_articles', 'articles.category_article_id', '=', 'category_articles.id')
        ->get(['articles.*', 'category_articles.name AS category_article_name']);
        return view('admin.articles.list',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_articles = CategoryArticle::all();
        return view('admin.articles.add', compact('category_articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/articles', $request->image->getClientOriginalName());
                Article::create([
                    'title' => $request->title,
                    'description' => $request->content,
                    'category_article_id' => $request->category_article_id,
                    'thumbnail' => '/storage/images/articles/' . $request->image->getClientOriginalName(),
                    'view' => $request->view
                ]);
                return redirect()->route('article.list')->with('success', 'Lưu thành công');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_articles = CategoryArticle::all();
        $article = Article::find($id);
        return view('admin.articles.edit', compact('article', 'category_articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/articles', $request->image->getClientOriginalName());
                $article->thumbnail = '/storage/images/articles/' . $request->image->getClientOriginalName();
            }
        }
        $article->title = $request->title;
        $article->description = $request->content;
        $article->category_article_id = $request->category_article_id;
        $article->view = $request->view;
        $article->save();
        return redirect()->route('article.list')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.list')->with('success', 'Xóa thành công');
    }
}