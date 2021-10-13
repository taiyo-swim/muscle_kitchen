@extends('layouts.app')  <!--フォロワー一覧表示-->

@section('content')
<div class="following_list">
    <div id="following-title" class="follower_count">
            <h4>{{ $auth->name }}のフォロワー：{{ $follower_count }}人</h4>
    </div>
    
    
    <div id="following-users">
        @foreach ($followers as $follower)
            <div id="following-user" class="user_follower">
                <div class="user-image">
                    @if ($follower->image_path)
                        <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $follower->image_path }}"/>
                    @else
                        <img src="{{asset('defaultuser.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                    @endif
                </div>
                <h4 class="user_name" style="margin-top: 13px;"><a href="/users/{{ $follower->id }}">{{ $follower->name }}</a></h4>  <!--フォロワーの情報表示-->
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $followers->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
</div>

        <style>
            .user-image img {
                object-fit: cover;
                object-position: center top;
                float: left;
                margin-right: 20px; 
                border-radius: 50%; 
                width: 50px; 
                height: 50px;
                border: solid;
                border-color: black;
            }
        </style>
@endsection