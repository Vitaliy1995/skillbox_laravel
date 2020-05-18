<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest("updated_at")->where('published', 1)->get();

        return view("index", compact('articles'));
    }

    public function create()
    {
        $validatedData = $this->validate(\request(), [
            "slug" => "regex:/^([a-zA-Z]{1})([\w\-\_]*)([\w]{1})$/i|unique:articles,slug|required",
            "name" => "min:5|max:100|required",
            "annotation" => "max:255|required",
            "description" => "required",
        ]);

        if (\request('published')) {
            $validatedData['published'] = true;
        }

        Article::create($validatedData);

        return redirect("/");
    }

    public function detail(Article $article)
    {
        return view("posts.detail", compact('article'));
    }
}
