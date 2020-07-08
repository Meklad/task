<?php

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

Route::get('/', function () {
    $news = \App\News::with('author')->orderBy('created_at', 'DESC')->paginate(5);
    return view('welcome')->with(['news' => $news]);
});

Route::get('/news/blog/{id}', function ($id) {
    $news = \App\News::find($id);
    return view('featured_news.news')->with(['news' => $news]);
})->name('news.blog');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('news', 'NewsController');
