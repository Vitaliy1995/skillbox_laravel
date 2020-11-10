<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
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

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::resource('/posts', 'ArticleController')->parameters([
    'posts' => 'article'
]);

Route::get('/admin/feedbacks', 'TreatmentController@index');

Route::view('/about', 'about');

Route::view('/contacts', 'contacts');

Route::post('/contacts', 'TreatmentController@add');
