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
        view()->composer('admin.layouts.index', function ($view) {
            $data1 =  DB::select(
                'SELECT MONTH(b.created_at) bill_month, SUM(p.room_price + p.water_price + p.electricity_price) total_price 
                 FROM orders o, bills b, products p 
                 WHERE b.status = 1 AND b.order_id = o.id AND o.product_id = p.id
                 GROUP BY bill_month'
            );
            $data2 = DB::select(
                'SELECT YEAR(b.created_at) bill_year, SUM(p.room_price + p.water_price + p.electricity_price) total_price 
                 FROM orders o, bills b, products p 
                 WHERE b.status = 1 AND b.order_id = o.id AND o.product_id = p.id
                 GROUP BY bill_year'
            );
            $view->with(['data1' => $data1, 'data2' => $data2]);
        });
    }
}
