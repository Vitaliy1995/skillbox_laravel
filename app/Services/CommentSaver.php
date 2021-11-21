<?php


namespace App\Services;


use App\Comment;
use App\Http\Requests\CommentRequest;
use App\ModelWithComments;

class CommentSaver
{
    public function save(ModelWithComments $model, CommentRequest $request)
    {
        $validatedData = $request->validated();

        $model->comments()->save(new Comment([
            'owner_id' => auth()->id(),
            'comment' => $validatedData['comment'],
        ]));

        flash('Комментарий успешно добавлен!');

        return back();
    }
}
