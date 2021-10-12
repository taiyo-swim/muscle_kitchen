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
            'recipe_post.title' => 'required|string|max:20',
            'recipe_post.explanation' => 'required|string|max:100',
            'tags.*' => 'required|regex:/#([a-zA-z0-9０-９ぁ-んーァ-ンヴー一-龠]+)/u|max:100',
            'image_path' => 'nullable',
            'recipe_post.serving' => 'required|int',
            'recipe_post.ingredients' => 'required',
            'recipe_post.amount_of_ingredients' => 'required',
            'recipe_post.how_to_cook' => 'required',
            'recipe_post.point' => 'nullable|string|max:100'
        ];
    }
}
