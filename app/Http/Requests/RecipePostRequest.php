<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /**public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()  //レシピ投稿のバリデーションルールを記述
    {
        return [
            'recipe_post.title' => 'required|string|max:50',
            'recipe_post.explanation' => 'required|string|max:200',
            'tags' => 'required|regex:/#([a-zA-z0-9０-９ぁ-んァ-ヶ一-龠]+)/u',
            'recipe_post.image' => 'nullable|image',
            'recipe_post.ingredients' => 'required|string',
            'recipe_post.how_to_cook' => 'required|string',
            'recipe_post.point' => 'nullable|string'
        ];
    }
}
