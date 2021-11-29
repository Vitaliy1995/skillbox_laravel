<?php


namespace App\Services;


use App\Comment;
use App\ModelWithComments;
use Illuminate\Contracts\Auth\Authenticatable;

class CommentSaver
{
    public function save(ModelWithComments $model, Authenticatable $user, $validatedData)
    {
        $model->comments()->save(new Comment([
            'owner_id' => $user->id,
            'comment' => $validatedData['comment'],
        ]));

        flash('Комментарий успешно добавлен!');

        return back();
    }
}
