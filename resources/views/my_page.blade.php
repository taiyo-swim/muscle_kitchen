@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title"></div>
            <h2>マイページ</h>
        </div>
        
        <div class="information">
            <p>ユーザー名：{{ $my_user->name }}</p>
            <p>メールアドレス：{{ $my_user->email }}</p>
        </div>
        
        <p><a href="/my_page/my_recipes">マイレシピ</a></p>
        <p><a href="/my_page/my_nice_recipes">いいねしたレシピ</a></p>
        
        
        <div class="recipe_images">
            <h3>投稿した写真</h3>
            @foreach($recipes as $recipe)
                @if($recipe->image_path)
                    <a href="/recipes/{{ $recipe->id }}">
                        <img class="recipe_image" src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}"width="200 height="120/>
                    </a>
                @endif
            @endforeach
        </div>
       
@endsection