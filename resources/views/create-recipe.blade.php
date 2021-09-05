<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Recipe</title>
    </head>
    <body>
        <h1>レシピ投稿</h1>
        <form action="/recipes" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>レシピ名</h2>
                <input type="text" name="recipe_post[title]" placeholder="鶏むね肉の味噌マヨネーズ焼き" value="{{ old('recipe_post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('recipe_post.title') }}</p>
            </div>
            <div class="explanation">
                <h2>レシピの説明</h2>
                <textarea name="recipe_post[explanation]" placeholder="鶏むね肉をしっとり食べたいならおすすめです。">{{ old('recipe_post.explanation') }}</textarea>
                <p class="explanation__error" style="color:red">{{ $errors->first('recipe_post.explanation') }}</p>
            </div>
            <div class="tags">
                <h2>タグ</h2>
                <input id="tags" name="tags" type="text" placeholder="#鶏むね肉" value="{{ old('tags') }}"/>
                <p class="tags__error" style="color:red">{{ $errors->first('tags') }}</p>
            </div>
            <div class="image">
                <h2>画像</h2>
                <input id="image" type="file" name="recipe_post[image]"/>
                <p class="image__error" style="color:red">{{ $errors->first('recipe_post.image') }}</p>
            </div>
            <div class="ingredients">
                <h2>食材</h2>
                <textarea name="recipe_post[ingredients]" placeholder="3人前&#13;&#10;鶏むね肉：200g　味噌：5g">{{ old('recipe_post.ingredients') }}</textarea>
                <p class="ingredients__error" style="color:red">{{ $errors->first('recipe_post.ingredients') }}</p>
            </div>
            <div class="how_to_cook">
                <h2>作り方</h2>
                <textarea name="recipe_post[how_to_cook]" placeholder="1．鶏むね肉を食べやすい大きさに切る。&#13;&#10;2．味噌とマヨネーズを混ぜ合わせる。">{{ old('recipe_post.how_to_cook') }}</textarea>
                <p class="how_to_cook__error" style="color:red">{{ $errors->first('recipe_post.how_to_cook') }}</p>
            </div>
            <div class="point">
                <h2>ポイント</h2>
                <textarea name="recipe_post[point]" placeholder="鶏むね肉は弱火でじっくり焼くとしっとり仕上がります。">{{ old('recipe_post.point') }}</textarea>
                <p class="point__error" style="color:red">{{ $errors->first('recipe_post.point') }}</p>
            </div>
            <input type="submit" value="投稿"/>
        </form>
        <div class="back">[<a href="/home">戻る</a>]</div>
    </body>
</html>