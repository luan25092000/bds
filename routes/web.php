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

// Client
Route::group(['namespace'=>'Client'],function(){
    Route::get('/login', 'AuthController@showLogin')->name('auth.show.login');
    Route::post('/login', 'AuthController@login')->name('auth.post.login');
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');
    Route::get('/forget-password', 'AuthController@forgetPassword')->name('forget.password');
    Route::post('/sendmail-confirm', 'AuthController@postSendmail')->name('send.mail');
    Route::get('/change-password/{token}','AuthController@showChangePassword');
    Route::post('/change-password','AuthController@updatePassword')->name('update.password');
    Route::get('/','ClientController@index')->name('home');
    Route::get('/introduce','ClientController@introduce')->name('introduce');
    Route::get('/project','ClientController@project')->name('project');
    Route::group(['middleware' => 'filter.project'], function() {
        Route::get('/project/detail/{id}','ClientController@projectDetail')->name('project.detail');
    });
    Route::get('/article','ClientController@article')->name('article');
    Route::group(['middleware' => 'filter.product'], function() {
        Route::get('/product/detail/{id}','ClientController@productDetail')->name('product.detail');
    });
    Route::get('/product/category/{id}','ClientController@productCategory')->name('product.category');
    Route::get('/wishlist','ClientController@wishlist')->name('wishlist');
    Route::group(['middleware' => 'filter.article'], function() {
        Route::get('/article/detail/{id}','ClientController@articleDetail')->name('article.detail');
    });
    Route::get('/contact','ClientController@contact')->name('contact');
    Route::post('/contact','ClientController@postContact')->name('post.contact');
    Route::get('/add-wishlist', 'ClientController@addWishlist');
    Route::get('/wishlist','ClientController@wishlist')->name('wishlist');
    Route::get('/delete/wishlist/id/{id}','ClientController@deleteWishlist')->name('wishlist.delete');
    Route::get('/contract/wishlist/id/{id}','ClientController@contractWishlist')->name('wishlist.contract');
    Route::post('/search','ClientController@postSearch')->name('post.search');
    Route::get('/ajax_district','ClientController@ajaxDistrict');
    Route::get('/ajax_ward','ClientController@ajaxWard');
    Route::post('/contract/{id}','ClientController@postContract')->name('post.contract');
    Route::get('/bill','ClientController@bill')->name('bill');
    Route::get('/order','ClientController@order')->name('order');
});

// Admin
Route::namespace('Admin')->prefix('ad')->group(function () {
    Route::get('/', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role == 1) {
                return redirect()->route('product.list');
            } else {
                return redirect()->route('admin.form.login')->with('invalid', 'Bạn không có quyền truy cập hệ thống');
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
        Route::get('filter-bill', 'DashboardController@fillterBill')->name('fillter.bill');
        Route::get('export-bill-excel', 'DashboardController@exportExcel')->name('bill.export.excel');
        // Project
        Route::group(['prefix'=>'project'],function(){
            Route::get('list','ProjectController@index')->name('project.list');
            
            Route::get('edit/{id}','ProjectController@edit')->name('project.edit.form');

            Route::post('edit/{id}','ProjectController@update')->name('project.edit');

            Route::get('add','ProjectController@create')->name('project.add.form');

            Route::post('add','ProjectController@store')->name('project.add');
            
            Route::get('delete/{id}','ProjectController@destroy')->name('project.delete');

            Route::get('update/{status}/{id}', 'ProjectController@updateStatus')->name('project.update.status');
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

            Route::get('ajax_district','ProductController@ajaxDistrict');
            
            Route::get('ajax_ward','ProductController@ajaxWard');
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
        // Contact
        Route::group(['prefix'=>'contact'],function(){
            Route::get('list','ContactController@index')->name('contact.list');

            Route::get('delete/{id}','ContactController@destroy')->name('contact.delete');
        });
        // Order
        Route::group(['prefix'=>'order'],function(){
            Route::get('list','OrderController@index')->name('order.list');

            Route::get('delete/{id}','OrderController@destroy')->name('order.delete');

            Route::get('not-see/{id}','OrderController@notSee')->name('order.not.see');

            Route::get('see/{id}','OrderController@see')->name('order.see');

            Route::get('done/{id}','OrderController@update')->name('order.done');

            Route::get('send-bill/{id}','OrderController@sendBill')->name('order.send.bill');

            Route::post('add/{id}','OrderController@store')->name('customer.order.add');
        });
         // Bill
         Route::group(['prefix'=>'bill'],function(){
            Route::get('list','BillController@index')->name('bill.list');

            Route::get('update-status/{id}','BillController@update')->name('bill.update.status');
        });
    });
});
