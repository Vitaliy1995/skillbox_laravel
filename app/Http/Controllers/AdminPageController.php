<?php

namespace App\Http\Controllers;

use App\Jobs\TotalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdminPageController extends Controller
{
    public function statistic()
    {
        $stat = Cache::tags(['articles', 'users', 'news', 'articleHistory', 'articleComment'])
            ->remember('fullStat', 3600, function () {
                $stat['articlesCount'] = \App\Article::count();

                $stat['newsCount'] = \App\News::count();

                $stat['userNameWithMaxArticlesCount'] = \App\User::withCount('articles')
                    ->orderBy('articles_count', 'desc')
                    ->first()
                    ->name;

                $stat['articleWithMaxDescriptionLength'] = \App\Article::select(
                    'name',
                    'slug',
                    DB::raw("LENGTH(description) as length")
                )
                    ->orderByDesc('length')
                    ->first();

                $stat['articleWithMinDescriptionLength'] = \App\Article::select(
                    'name',
                    'slug',
                    DB::raw("LENGTH(description) as length")
                )
                    ->orderBy('length')
                    ->first();

                $stat['avgUsersArticles'] = \App\User::whereHas('articles')
                    ->withCount('articles')
                    ->get()
                    ->avg('articles_count');

                $stat['articleWithMaxChanges'] = \App\Article::select('name', 'slug')
                    ->withCount('history')
                    ->orderByDesc('history_count')
                    ->first();

                $stat['articleWithMaxComments'] = \App\Article::select('name', 'slug')
                    ->withCount('comments')
                    ->orderByDesc('comments_count')
                    ->first();

                return $stat;
            }
        );

        return view("admin.reports.statistic", compact('stat'));
    }

    public function total(Request $request)
    {
        TotalReport::dispatchNow(
            $request->has('news'),
            $request->has('articles'),
            $request->has('comments'),
            $request->has('tags'),
            $request->has('users')
        );
    }

}
