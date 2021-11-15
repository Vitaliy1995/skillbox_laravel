<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Article $article, Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'min:5|max:3000|required'
        ]);

        $validatedData['owner_id'] = auth()->id();
        $validatedData['article_id'] = $article->id;

        Comment::create($validatedData);

        flash('Комментарий успешно добавлен!');

        return redirect(route('posts.show', ['article' => $article]));
    }
}
