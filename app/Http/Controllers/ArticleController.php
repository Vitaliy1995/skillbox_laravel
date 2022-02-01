<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlePostRequest;
use App\Services\TagsSynchronizer;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    private $tagsSynchronizer;

    public function __construct(TagsSynchronizer $tagsSynchronizer)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('can:update,article')->except(['index', 'show', 'create', 'store']);

        $this->tagsSynchronizer = $tagsSynchronizer;
    }

    public function index()
    {
        $articles = Cache::tags(['articles', 'tags'])->remember('articlesList|' . request('page', 1), 3600, function () {
            return Article::with('tags')
                ->latest("updated_at")
                ->where('published', true)
                ->paginate(10);
        });

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

        $this->tagsSynchronizer->sync($article, \request('tags'));

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

        $this->tagsSynchronizer->sync($article, \request('tags'));

        flash('Статья успешно обновлена!');

        return redirect(route('posts.index'));
    }

    public function destroy(Article $article)
    {
        $article->delete();

        flash('Статья успешно удалена!', 'warning');

        return redirect(route('posts.index'));
    }
}
