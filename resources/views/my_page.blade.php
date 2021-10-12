@extends('layouts.app')

@section('content')
        <div class="user-title">
            <h2>マイページ</h>
        </div>
        
        <div class="user-information">
            <h4>ユーザー名：{{ $my_user->name }}</h4>
            <h4>メールアドレス：{{ $my_user->email }}</h4>
            <div class="following">
                <h5><a class="follower" href="/my_page/follower">{{ $follower_count }}フォロワー</a></h5>
                <h5><a class="follow" href="/my_page/follow">{{ $follow_count }}フォロー</a></h5>
            </div>
        </div>
        
        <div class="user-recipe">
            <h4><a href="/my_page/my_recipes">マイレシピ</a></h4>
            <h4><a href="/my_page/my_nice_recipes">いいねしたレシピ</a></h4>
        </div>
        
        
        
        <div class="recipe_images">
            <h3>・投稿した写真</h3>
                <div class="image-link">
                    @foreach($recipes as $recipe)
                        @if($recipe->image_path)
                            <a href="/recipes/{{ $recipe->id }}">
                                <img class="recipe_image" src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}"width="200 height="120/>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
@endsection