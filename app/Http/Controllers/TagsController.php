<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = Cache::tags(['articles', 'tags'])->remember('articlesTags', 3600, function () use ($tag) {
            return $tag->articles()->with('tags')->get();
        });
        $allNews = Cache::tags(['news', 'tags'])->remember('newsTags', 3600, function () use ($tag) {
            return $tag->news()->with('tags')->get();
        });

        return view('tags.index', compact('articles', 'allNews'));
    }
}
