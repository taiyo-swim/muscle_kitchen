@extends('layouts.app')  <!--ユーザーのフォロワー一覧表示-->

@section('content')
<div class="following_list">
    <div id="following-title" class="follower_count">
            <h4>{{ $user->name }}のフォロワー：{{ $follower_count }}人</h4>
    </div>
    
    <div id="following-users">
        @foreach ($followers as $follower)
            <div id="following-user" class="user_follower">
            @if ($follower->id === $auth)  <!--フォロワーが自分のとき-->
                <h4 class="user_name"><a href="/my_page">{{ $follower->name }}</a></h4>
            @else  <!--フォロワーが自分ではないとき-->
                <h4 class="user_name"><a href="/users/{{ $follower->id }}">{{ $follower->name }}</a></h4>
            @endif
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $followers->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
        
</div>
@endsection