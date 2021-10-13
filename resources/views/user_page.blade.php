@extends('layouts.app')

@section('content')
        <div class="user-title">
            <h2>ユーザーページ</h>
        </div>
        
        <div class="user-information">
            <div class="user-image">
            @if ($user->image_path)
                <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/profile/{{ $user->image_path }}" width="400 height="300/>
            @else
                <img src="{{asset('defaultuser.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
            @endif
            </div>
            <h4>ユーザー名：{{ $user->name }}</h4>
            
            <div class="following">
                <div id="el">
                    <follow-component  {{--FollowComponentを読み込む--}}
                    :user-id = "{{ json_encode($user->id) }}"  {{--json_encodeで値をjson形式にする--}}
                    :default-followed = "{{ json_encode($defaultFollowed) }}"
                    :default-count = "{{ json_encode($defaultCount) }}"
                    ></follow-component>
                </div>
                <h5 class="follow"><a href="/users/{{ $user->id }}/follow">{{ $follow_count }}フォロー</a></h5>
            </div>
        </div>
        
        
        <div class="user-recipe">
            <h4><a href="/users/{{ $user->id }}/recipes">{{ $user->name }}のレシピ</a></h4>
            <h4><a href="/users/{{ $user->id }}/nice_recipes">{{ $user->name }}がいいねしたレシピ</a></h4>
        </div>
        
        <div class="recipe_images">
            <h3>・{{ $user->name }}が投稿した写真</h3>
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
        
        <style>
            .user-image img {
                object-fit: cover;
                object-position: center top;
                float: left;
                margin: 15px 30px 0 0; 
                border-radius: 50%; 
                width: 100px; 
                height: 100px;
                border: solid;
                border-color: black;
            }
        </style>
@endsection