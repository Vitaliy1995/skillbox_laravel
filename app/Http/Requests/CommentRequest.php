<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'comment' => 'min:5|max:3000|required'
        ];
    }
}
