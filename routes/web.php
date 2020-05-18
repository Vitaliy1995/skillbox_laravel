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

Route::get('/', 'ArticleController@index');

Route::get('/posts/create', function () {
    return view('posts.create');
});

Route::post('/posts', 'ArticleController@create');

Route::get('/posts/{article}', 'ArticleController@detail');

Route::get('/admin/feedbacks', 'TreatmentController@index');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::post('/contacts', 'TreatmentController@add');
