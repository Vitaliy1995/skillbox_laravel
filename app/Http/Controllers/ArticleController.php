<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('tags')
            ->latest("updated_at")
            ->where('published', 1)
            ->get();

        return view("index", compact('articles'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $validatedData = \request()->validate([
            "slug" => "regex:/^([a-zA-Z]{1})([\w\-\_]*)([\w]{1})$/i|unique:articles,slug|required",
            "name" => "min:5|max:100|required",
            "annotation" => "max:255|required",
            "description" => "required",
        ]);

        if (\request('published')) {
            $validatedData['published'] = true;
        }

        Article::create($validatedData);

        return redirect("/posts");
    }

    public function show(Article $article)
    {
        return view("posts.detail", compact('article'));
    }

    public function edit(Article $article)
    {
        return view("posts.edit", compact('article'));
    }

    public function update(Article $article)
    {
        $validatedData = \request()->validate([
            "name" => "min:5|max:100|required",
            "annotation" => "max:255|required",
            "description" => "required",
        ]);

        $validatedData['published'] = (bool)(\request('published'));

        $article->update($validatedData);

        /** @var \Illuminate\Support\Collection $articleTags */
        $articleTags = $article->tags->keyBy('name');
        $formTags = collect(explode(",", \request('tags')))->keyBy(function ($item) {return $item;});

        $syncIds = $articleTags->intersectByKeys($formTags)->pluck('id')->toArray();

        $tagsToAttach = $formTags->diffKeys($articleTags);
        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $article->tags()->sync($syncIds);

        return redirect("/posts");
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect("/posts");
    }
}
