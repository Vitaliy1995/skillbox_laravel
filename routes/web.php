<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\AdminPageController;

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

Route::resource('/posts', 'ArticleController')->parameters([
    'posts' => 'article'
]);

Route::post('/posts/{article}/comment', 'CommentController@storeArticle')->name('comment.store');

Route::get('/news', 'NewsController@index')->name('news.main');
Route::get('/news/{news}', 'NewsController@show')->name('news.show');
Route::post('/news/{news}/comment', 'CommentController@storeNews')->name('news.comment.store');

Route::get('/tags/{tag}', 'TagsController@index')->name('tags');

Route::view('/about', 'about')->name('about');

Route::view('/contacts', 'contacts')->name('contacts');

Route::post('/contacts', 'TreatmentController@add')->name('contacts.add');

Route::view('/admin', 'admin.index')->name('admin');

Route::view('/admin/reports', 'admin.reports.index')->name('admin.reports');

Route::view('/admin/total', 'admin.reports.total')->name('admin.total');
Route::post('/admin/total', 'AdminPageController@total')->name('admin.total.post');

Route::get('/admin/feedbacks', 'TreatmentController@index')->name('admin.feedback');

Route::resource('/admin/posts', 'AdminPostsController')->parameters([
    'posts' => 'article'
])->names('admin.posts');

Route::resource('/admin/news', 'NewsController')->names('admin.news');

Route::get('/admin/statistic', 'AdminPageController@statistic')->name('admin.statistic');

Auth::routes();
