@extends('layouts.app')

@section('content')
        <div class="form-title">
            <h2>レシピ編集</h2>
        </div>
        
        <div class="recipe-form">
            <form action="/recipes/{{ $recipe->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-recipe-title">
                    <h4>レシピ名(14文字以内)</h4>
                    <label>
                        <input type="text" name="recipe_post[title]"  value="{{ $recipe->title }}"/>
                    </label>
                    <p class="title__error" style="color:red">{{ $errors->first('recipe_post.title') }}</p>
                </div>
                
                <div class="form-explanation">
                    <h4>レシピの説明(100文字以内)</h4>
                    <textarea id="textarea" name="recipe_post[explanation]">{{ $recipe->explanation }}</textarea>
                    <p class="explanation__error" style="color:red">{{ $errors->first('recipe_post.explanation') }}</p>
                </div>
                
                <div class="form-tags">
                    <h4>タグ(半角の「#」をつけてください)</h4>
                    <input id="tags" name="tags" type="text" value="{{ $recipe->makeTag() }}"/>  <!--recipeモデルクラスのmakeTagメソッドを使用-->
                    <p class="tags__error" style="color:red">{{ $errors->first('tags') }}</p>
                </div>
                
                <div class="form-image">
                    <h4>画像</h4>
                    <label for="image">
                            ファイルを選択
                            <input id="image" type="file" name="image"/>
                    </label>
                    <span>ファイルが選択されていません</span>
                    <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
                </div>
                
                <div class="form-ingredients">
                    <h4>食材</h4>
                    <input id="serving" name="recipe_post[serving]" value="{{ $recipe->serving}}">人前
                    <p class="serving__error" style="color:red">{{ $errors->first('recipe_post.serving') }}</p>
                    <ol id="ingredients_order_list" style="list-style-type:none;">
                        @if ($amount_of_ingredients_count > 1)
                            @for ($i = 0; $i < $ingredients_count; $i++)
                                <li>
                                    <input id="ingredients" name="recipe_post[ingredients][] " value="{{ $recipe_ingredients[$i] }}">
                                    <input id="amount_of_ingredients" name="recipe_post[amount_of_ingredients][]" value="{{ $recipe_amount_of_ingredients[$i] }}">
                                </li>
                            @endfor
                        @else
                            <li>
                                <input id="ingredients" name="recipe_post[ingredients][] " value="{{ $recipe_ingredients[0] }}">
                                <input id="amount_of_ingredients" name="recipe_post[amount_of_ingredients][]" value="{{ $recipe_amount_of_ingredients[0] }}">
                            </li>
                        @endif
                    </ol>
                    <p class="ingredients__error" style="color:red">{{ $errors->first('recipe_post.ingredients.0') }}</p>
                    <p class="amount_of_ingredients__error" style="color:red">{{ $errors->first('recipe_post.amount_of_ingredients.0') }}</p>
                    <div class="form-add-button">
                        <input type="button" value="+" id="ingredients_btn_add">
                    </div>
                </div>
                
                <div class="form-how_to_cook">
                    <h4>作り方</h4>
                    <ol id="how_to_cook_order_list">
                        @if ($how_to_cook_count > 1)
                            @for ($i = 0; $i < $how_to_cook_count; $i++)
                                <li>
                                    <input  id="how_to_cook" name="recipe_post[how_to_cook][]" value="{{ $recipe_how_to_cook[$i] }}">
                                </li>
                            @endfor
                        @else
                            <li>
                                <input  id="how_to_cook" name="recipe_post[how_to_cook][]" value="{{ $recipe_how_to_cook[0] }}">
                            </li>
                        @endif
                    </ol>
                    <p class="how_to_cook__error" style="color:red">{{ $errors->first('recipe_post.how_to_cook.0') }}</p>
                    <div class="form-add-button">
                        <input type="button" value="+" id="how_to_cook_btn_add">
                    </div>
                </div>
                
                <div class="form-point">
                    <h4>ポイント(100文字以内)</h4>
                    <textarea id="textarea" name="recipe_post[point]">{{ $recipe->point }}</textarea>
                    <p class="point__error" style="color:red">{{ $errors->first('recipe_post.point') }}</p>
                </div>
                
                <div class="form-submit">
                    <input type="submit" value="アップデート"/>
                </div>
            </form>
        </div>
        
        <script>
        window.addEventListener('DOMContentLoaded', function()   {{--ファイルパス表示用の処理--}}
        {
            $('input').on('change', function ()
            {
                var file = $(this).prop('files')[0];
                $('span').text(file.name);
            });
        });
        </script>
        
@endsection