<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Project;
use App\Models\Article;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::all();
        $projects = Project::orderBy('view', 'DESC')->orderBy('id','DESC')->take(5)->get();
        $articles = Article::orderBy('view', 'DESC')->orderBy('id','DESC')->take(5)->get();
        View::share('categories', $categories);
        View::share('projects', $projects);
        View::share('articles', $articles);
    }
}
