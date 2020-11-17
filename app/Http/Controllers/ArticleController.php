<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlePostRequest;
use App\Tag;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('can:update,article')->except(['index', 'show', 'create', 'store']);
    }

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

    public function store(ArticlePostRequest $request)
    {
        $validatedData = $request->validated();

        if (\request()->has('published')) {
            $validatedData['published'] = true;
        }

        $validatedData['owner_id'] = auth()->id();

        $article = Article::create($validatedData);

        $this->syncTagsWithArticle($article, \request('tags'));

        flash('Статья создана успешно!');

        return redirect(route('posts.index'));
    }

    public function show(Article $article)
    {
        return view("posts.detail", compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view("posts.edit", compact('article'));
    }

    public function update(Article $article, ArticlePostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['published'] = \request()->has('published');

        $article->update($validatedData);

        $this->syncTagsWithArticle($article, \request('tags'));

        flash('Статья успешно обновлена!');

        return redirect(route('posts.index'));
    }

    public function destroy(Article $article)
    {
        $article->delete();

        flash('Статья успешно удалена!', 'warning');

        return redirect(route('posts.index'));
    }

    private function syncTagsWithArticle(Article $article, $tags)
    {
        /** @var \Illuminate\Support\Collection $articleTags */
        $articleTags = $article->tags->keyBy('name');
        $formTags = collect(explode(",", $tags))->keyBy(function ($item) {return $item;});

        $syncIds = $articleTags->intersectByKeys($formTags)->pluck('id')->toArray();

        $tagsToAttach = $formTags->diffKeys($articleTags);
        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $article->tags()->sync($syncIds);
    }
}
