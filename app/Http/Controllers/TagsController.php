<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->get();
        $allNews = $tag->news()->with('tags')->get();

        return view('tags.index', compact('articles', 'allNews'));
    }
}
