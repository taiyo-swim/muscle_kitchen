@extends('layouts.app')

@section('content')
        <div class="form-title">
            <h2>レシピ投稿</h2>
        </div>
        
        <div class="recipe-form">
            <form action="/recipes" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-recipe-title">
                    <h4>レシピ名(14文字以内)</h4>
                    <label>
                        <input type="text" name="recipe_post[title]" placeholder="鶏むね肉の味噌マヨネーズ焼き" value="{{ old('recipe_post.title') }}"/>
                    </label>
                    <p class="title__error" style="color:red">{{ $errors->first('recipe_post.title') }}</p>
                </div>
                
                <div class="form-explanation">
                    <h4>レシピの説明(100文字以内)</h4>
                    <textarea id="textarea" name="recipe_post[explanation]" placeholder="鶏むね肉をしっとり食べたいならおすすめです。">{{ old('recipe_post.explanation') }}</textarea>
                    <p class="explanation__error" style="color:red">{{ $errors->first('recipe_post.explanation') }}</p>
                </div>
                
                <div class="form-tags">
                    <h4>タグ(半角の「#」をつけてください)</h4>
                    <input id="tags" name="tags" type="text" placeholder="#鶏むね肉" value="{{ old('tags') }}"/>
                    <p class="tags__error" style="color:red">{{ $errors->first('tags') }}</p>
                </div>
                
                <div class="form-image">
                    <h4>画像</h4>
                    <label for="image">
                        ファイルを選択(1MG以内)
                        <input id="image" type="file" name="image"/>
                    </label>
                    <span class="recipe_image_path">ファイルが選択されていません</span>
                    <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
                </div>
                
                <div class="form-ingredients">
                    <h4>食材</h4>
                    <input id="serving" name="recipe_post[serving]">人前
                    <ol id="ingredients_order_list" style="list-style-type:none;">
                        <li>
                            <input type="text" id="ingredients" name="recipe_post[ingredients][]" placeholder="鶏むね肉">
                            <input type="text" id="amount_of_ingredients" name="recipe_post[amount_of_ingredients][]" placeholder="200g">
                        </li>
                    </ol>
                        <div class="form-add-button">
                            <input type="button" value="+" id="ingredients_btn_add">
                        </div>
                    <p class="ingredients__error" style="color:red">{{ $errors->first('recipe_post.ingredients') }}</p>
                </div>
                
                <div class="form-how_to_cook">
                    <h4>作り方</h4>
                    <ol id="how_to_cook_order_list">
                        <li>
                            <input  type="text" id="how_to_cook" name="recipe_post[how_to_cook][]" placeholder="鶏むね肉を食べやすい大きさに切る。">
                        </li>
                    </ol>
                    <div class="form-add-button">
                        <input type="button" value="+" id="how_to_cook_btn_add">
                    </div>
                    <p class="how_to_cook__error" style="color:red">{{ $errors->first('recipe_post.how_to_cook') }}</p>
                </div>
                    
                <div class="form-point">
                    <h4>ポイント(100文字以内)</h4>
                            <textarea id="textarea" name="recipe_post[point]" placeholder="鶏むね肉は弱火でじっくり焼くとしっとり仕上がります。">{{ old('recipe_post.point') }}</textarea>
                    <p class="point__error" style="color:red">{{ $errors->first('recipe_post.point') }}</p>
                </div>
                <div class="form-submit">
                    <input type="submit" value="投稿"/>
                </div>
            </form>
        </div>
    
    <script>
        window.addEventListener('DOMContentLoaded', function()   {{--ファイルパス表示用の処理--}}
        {
            $('input').on('change', function ()
            {
                var file = $(this).prop('files')[0];
                $('.recipe_image_path').text(file.name);
            });
        });
        
    </script>
@endsection