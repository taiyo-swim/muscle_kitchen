@extends('layouts.app')  <!--ユーザーのフォロー一覧表示-->

@section('content')
<div class="following_list">
    <div id="following-title" class="follow_count">
            <h4>{{ $user->name }}のフォロー：{{ $follow_count }}人</h4>
    </div>
    
    
    <div id="following-users">
        @foreach ($follows as $follow)
            <div id="following-user" class="user_follower">
            @if ($follow->id === $auth)  <!--フォローが自分のとき-->
                <div class="user-image">
                    @if ($follow->image_path)
                        <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $follow->image_path }}"/>
                    @else
                        <img src="{{asset('defaultuser.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                    @endif
                </div>
                <h4 class="user_name" style="margin-top: 13px;"><a href="/my_page">{{ $follow->name }}</a></h4>
            @else  <!--フォローが自分ではないとき-->
                <div class="user-image">
                    @if ($follow->image_path)
                        <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $follow->image_path }}"/>
                    @else
                        <img src="{{asset('defaultuser.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                    @endif
                </div>
                <h4 class="user_name" style="margin-top: 13px;"><a href="/users/{{ $follow->id }}">{{ $follow->name }}</a></h4>
            @endif
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $follows->links() }}  <!--ぺジネーションのリンクを追加-->
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
            }
        </style>
@endsection