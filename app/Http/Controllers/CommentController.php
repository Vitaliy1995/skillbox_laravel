<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\CommentRequest;
use App\News;
use App\Services\CommentSaver;

class CommentController extends Controller
{
    private $commentSaver;

    public function __construct(CommentSaver $commentSaver)
    {
        $this->middleware('auth');

        $this->commentSaver = $commentSaver;
    }

    public function storeArticle(Article $article, CommentRequest $request)
    {
        return $this->commentSaver->save($article, auth()->user(), $request->validated());
    }

    public function storeNews(News $news, CommentRequest $request)
    {
        return $this->commentSaver->save($news, auth()->user(), $request->validated());
    }
}
