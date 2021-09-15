<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Recipe</title>
    </head>
    <body>
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/recipes/{{ $recipe->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="content_title">
                    <h2>レシピ名</h2>
                    <input type="text" name="recipe_post[title]"  value="{{ $recipe->title }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('recipe_post.title') }}</p>
                </div>
            <div class="content_explanation">
                <h2>レシピの説明</h2>
                <textarea name="recipe_post[explanation]">{{ $recipe->explanation }}</textarea>
                <p class="explanation__error" style="color:red">{{ $errors->first('recipe_post.explanation') }}</p>
            </div>
            <div class="content_tags">
                <h2>タグ</h>
                <input id="tags" name="tags" type="text" value="{{$recipe->makeTag()}}"/>  <!--recipeモデルクラスのmakeTagメソッドを使用-->
                <p class="tags__error" style="color:red">{{ $errors->first('tags') }}</p>
            </div>
            <div class="content_image">
                <h2>画像</h2>
                <input id="image" type="file" name="image"/>
                <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
            </div>
            <div class="content_ingredients">
                <h2>食材</h2>
                <textarea name="recipe_post[ingredients]">{{ $recipe->ingredients }}</textarea>
                <p class="ingredients__error" style="color:red">{{ $errors->first('recipe_post.ingredients') }}</p>
            </div>
            <div class="content_how_to_cook">
                <h2>作り方</h2>
                <textarea name="recipe_post[how_to_cook]">{{ $recipe->how_to_cook }}</textarea>
                <p class="how_to_cook__error" style="color:red">{{ $errors->first('recipe_post.how_to_cook') }}</p>
            </div>
            <div class="content_point">
                <h2>ポイント</h2>
                <textarea name="recipe_post[point]">{{ $recipe->point }}</textarea>
                <p class="point__error" style="color:red">{{ $errors->first('recipe_post.point') }}</p>
            </div>
            <input type="submit" value="アップデート"/>
        </form>
        <div class="back">[<a href="/recipes/{{ $recipe->id }}">戻る</a>]</div>
    </body>
</html>