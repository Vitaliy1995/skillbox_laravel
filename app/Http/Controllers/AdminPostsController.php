<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlePostRequest;
use App\Services\TagsSynchronizer;
use App\Tag;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    private $tagsSynchronizer;

    public function __construct(TagsSynchronizer $tagsSynchronizer)
    {
        $this->middleware('auth');
        $this->middleware('can:admin-panel');

        $this->tagsSynchronizer = $tagsSynchronizer;
    }

    public function index()
    {
        $articles = Article::with('tags')
            ->latest("updated_at")
            ->get();

        return view("admin.posts.index", compact('articles'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(ArticlePostRequest $request)
    {
        $validatedData = $request->validated();

        if (\request()->has('published')) {
            $validatedData['published'] = true;
        }

        $validatedData['owner_id'] = auth()->id();

        $article = Article::create($validatedData);

        $this->tagsSynchronizer->sync($article, \request('tags'));

        flash('Статья создана успешно!');

        return redirect(route('admin.posts.index'));
    }

    public function show(Article $article)
    {
        return view("admin.posts.detail", compact('article'));
    }

    public function edit(Article $article)
    {
        return view("admin.posts.edit", compact('article'));
    }

    public function update(Article $article, ArticlePostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['published'] = \request()->has('published');

        $article->update($validatedData);

        $this->tagsSynchronizer->sync($article, \request('tags'));

        flash('Статья успешно обновлена!');

        return redirect(route('admin.posts.index'));
    }

    public function destroy(Article $article)
    {
        $article->delete();

        flash('Статья успешно удалена!', 'warning');

        return redirect(route('admin.posts.index'));
    }
}
