@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title"></div>
            <h2>ユーザーページ</h>
        </div>
        
        <div class="information">
            <p class="user-name">ユーザー名：{{ $user->name }}</p>
            <p class="follower"><a href="/users/{{ $user->id }}/follower">フォロワー</a></p>
            <p class="follow"><a href="/users/{{ $user->id }}/follow">フォロー</a></p>
            
            <div id="el">
                <follow-component  {{--FollowComponentを読み込む--}}
                :user-id = "{{ json_encode($user->id) }}"  {{--json_encodeで値をjson形式にする--}}
                :default-followed = "{{ json_encode($defaultFollowed) }}"
                :default-count = "{{ json_encode($defaultCount) }}"
                ></follow-component>
            </div>
        </div>
        
        
        
        <p><a href="/users/{{ $user->id }}/recipes">{{ $user->name }}のレシピ</a></p>
        <p><a href="/users/{{ $user->id }}/nice_recipes">{{ $user->name }}がいいねしたレシピ</a></p>
        
        
        <div class="recipe_images">
            <h3>{{ $user->name }}が投稿した写真</h3>
            @foreach($recipes as $recipe)
                @if($recipe->image_path)
                    <a href="/recipes/{{ $recipe->id }}">
                        <img class="recipe_image" src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}"width="200 height="120/>
                    </a>
                @endif
            @endforeach
        </div>
        
        
       
@endsection