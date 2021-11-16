<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\News;
use Illuminate\Support\Facades\Route;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('can:admin-panel')->except(['index', 'show']);
    }

    public function index()
    {
        $allNews = Route::currentRouteName() === "admin.news.index"
            ? News::paginate(20)
            : News::where('published', true)->paginate(10);

        return view('news.list', compact('allNews'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request)
    {
        $validatedData = $request->validated();

        if (\request()->has('published')) {
            $validatedData['published'] = true;
        }

        News::create($validatedData);

        flash('Новость создана успешно!');

        return redirect(route('admin.news.index'));
    }

    public function show(News $news)
    {
        return view("news.detail", compact('news'));
    }

    public function edit(News $news)
    {
        return view("admin.news.edit", compact('news'));
    }


    public function update(NewsRequest $request, News $news)
    {
        $validatedData = $request->validated();

        $validatedData['published'] = \request()->has('published');

        $news->update($validatedData);

        flash('Новость успешно обновлена!');

        return redirect(route('admin.news.index'));
    }


    public function destroy(News $news)
    {
        $news->delete();

        flash('Новость успешно удалена!', 'warning');

        return redirect(route('admin.news.index'));
    }
}
