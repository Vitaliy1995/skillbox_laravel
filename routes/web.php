<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/admin/feedbacks', 'TreatmentController@index')->name('admin.feedback');

Route::resource('/admin/posts', 'AdminPostsController')->parameters([
    'posts' => 'article'
])->names('admin.posts');

Route::resource('/admin/news', 'NewsController')->names('admin.news');

Route::get('/statistic', function () {
    dump(\App\Article::count());

    dump(\App\News::count());

    dump(\App\User::withCount('articles')
        ->orderBy('articles_count', 'desc')
        ->first()
        ->name);

    dump(
        DB::table('articles')
            ->select(
                'name',
                DB::raw("CONCAT('http://localhost:8000/posts/', slug) as url"),
                DB::raw("LENGTH(description) as length")
            )
            ->orderByDesc('length')
            ->first()
    );

    dump(
        DB::table('articles')
            ->select(
                'name',
                DB::raw("CONCAT('http://localhost:8000/posts/', slug) as url"),
                DB::raw("LENGTH(description) as length")
            )
            ->orderBy('length')
            ->first()
    );

    $articleCounts = DB::table('articles')
        ->select('owner_id', DB::raw("COUNT(articles.id) as articleCount"))
        ->groupBy('owner_id');
    dump(
        DB::table('users')
            ->joinSub($articleCounts, 'articles', function ($join) {
                $join->on('users.id', '=', 'articles.owner_id');
            })
            ->avg("articleCount")
    );

    dump(
        DB::table('articles')
            ->leftJoin('article_histories', 'articles.id', '=', 'article_histories.article_id')
            ->select(
                'name',
                DB::raw("CONCAT('http://localhost:8000/posts/', slug) as url"),
                DB::raw("COUNT(article_histories.id) as articleChangeCounts")
            )
            ->groupBy('articles.id')
            ->orderByDesc('articleChangeCounts')
            ->first()
    );

    dump(
        DB::table('articles')
            ->leftJoin('comments', function ($join) {
                $join->on('articles.id', '=', 'commentable_id')
                    ->where('commentable_type', '=', \App\Article::class);
            })
            ->select(
                'name',
                DB::raw("CONCAT('http://localhost:8000/posts/', slug) as url"),
                DB::raw("COUNT(comments.id) as commentsCounts")
            )
            ->groupBy('articles.id')
            ->orderByDesc('commentsCounts')
            ->first()
    );
});

Auth::routes();
