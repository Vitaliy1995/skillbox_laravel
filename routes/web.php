<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TreatmentController;

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

Route::get('/posts/tags/{tag}', 'TagsController@index')->name('posts.tags');

Route::resource('/posts', 'ArticleController')->parameters([
    'posts' => 'article'
]);

Route::post('/posts/{article}/comment', 'CommentController@store')->name('comment.store');

Route::get('/news', 'NewsController@index')->name('news.main');
Route::get('/news/{news}', 'NewsController@show')->name('news.show');

Route::view('/about', 'about')->name('about');

Route::view('/contacts', 'contacts')->name('contacts');

Route::post('/contacts', 'TreatmentController@add')->name('contacts.add');

Route::get('/admin/feedbacks', 'TreatmentController@index')->name('admin.feedback');

Route::resource('/admin/posts', 'AdminPostsController')->parameters([
    'posts' => 'article'
])->names('admin.posts');

Route::resource('/admin/news', 'NewsController')->names('admin.news');

Auth::routes();
