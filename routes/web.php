<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin
Route::namespace('Admin')->prefix('ad')->group(function () {
    Route::get('/', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                return redirect()->route('project.list');
            } else {
               
            }
        } else {
            return redirect()->route('admin.form.login');
        }
    });
    // Login, logout
    Route::get('/login', 'AuthController@showLoginForm')->name('admin.form.login');
    Route::post('/login', 'AuthController@login')->name('admin.handle.login');
    Route::get('/logout', 'AuthController@logout')->name('admin.handle.logout');

    Route::group(['middleware' => 'check.admin.login'], function() {
        // Dashboard
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        // Project
        Route::group(['prefix'=>'project'],function(){
            Route::get('list','ProjectController@index')->name('project.list');
            
            Route::get('edit/{id}','ProjectController@edit')->name('project.edit.form');

            Route::post('edit/{id}','ProjectController@update')->name('project.edit');

            Route::get('add','ProjectController@create')->name('project.add.form');

            Route::post('add','ProjectController@store')->name('project.add');
            
            Route::get('delete/{id}','ProjectController@destroy')->name('project.delete');
        });
        // Category
        Route::group(['prefix'=>'category'],function(){
            Route::get('list','CategoryController@index')->name('category.list');
            
            Route::get('edit/{id}','CategoryController@edit')->name('category.edit.form');

            Route::post('edit/{id}','CategoryController@update')->name('category.edit');

            Route::get('add','CategoryController@create')->name('category.add.form');

            Route::post('add','CategoryController@store')->name('category.add');
            
            Route::get('delete/{id}','CategoryController@destroy')->name('category.delete');
        });
        // Product
        Route::group(['prefix'=>'product'],function(){
            Route::get('list','ProductController@index')->name('product.list');
            
            Route::get('edit/{id}','ProductController@edit')->name('product.edit.form');

            Route::post('edit/{id}','ProductController@update')->name('product.edit');

            Route::get('add','ProductController@create')->name('product.add.form');

            Route::post('add','ProductController@store')->name('product.add');
            
            Route::get('delete/{id}','ProductController@destroy')->name('product.delete');

            Route::get('disable/{id}','ProductController@disable')->name('product.disable');

            Route::get('enable/{id}','ProductController@enable')->name('product.enable');
        });
        // User
        Route::group(['prefix'=>'user'],function(){
            Route::get('list','UserController@index')->name('customer.list');
            
            Route::get('edit/{id}','UserController@edit')->name('customer.edit.form');

            Route::post('edit/{id}','UserController@update')->name('customer.edit');

            Route::get('add','UserController@create')->name('customer.add.form');

            Route::post('add','UserController@store')->name('customer.add');
            
            Route::get('delete/{id}','UserController@destroy')->name('customer.delete');
        });
         // Category Article
         Route::group(['prefix'=>'category-article'],function(){
            Route::get('list','CategoryArticleController@index')->name('category.article.list');
            
            Route::get('edit/{id}','CategoryArticleController@edit')->name('category.article.edit.form');

            Route::post('edit/{id}','CategoryArticleController@update')->name('category.article.edit');

            Route::get('add','CategoryArticleController@create')->name('category.article.add.form');

            Route::post('add','CategoryArticleController@store')->name('category.article.add');
            
            Route::get('delete/{id}','CategoryArticleController@destroy')->name('category.article.delete');
        });
        // Article
        Route::group(['prefix'=>'article'],function(){
            Route::get('list','ArticleController@index')->name('article.list');
            
            Route::get('edit/{id}','ArticleController@edit')->name('article.edit.form');

            Route::post('edit/{id}','ArticleController@update')->name('article.edit');

            Route::get('add','ArticleController@create')->name('article.add.form');

            Route::post('add','ArticleController@store')->name('article.add');
            
            Route::get('delete/{id}','ArticleController@destroy')->name('article.delete');
        });
        // Order
        Route::group(['prefix'=>'order'],function(){
            Route::get('list','OrderController@index')->name('order.list');

            Route::post('edit/{id}','OrderController@update')->name('order.edit');
        });
    });
});
