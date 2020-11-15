<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validRules = [
            "name" => "min:5|max:100|required",
            "annotation" => "max:255|required",
            "description" => "required",
        ];

        if ($this->has('slug')) {
            $validRules["slug"] = "regex:/^([a-zA-Z]{1})([\w\-\_]*)([\w]{1})$/i|unique:articles,slug|required";
        }

        return $validRules;
    }
}
