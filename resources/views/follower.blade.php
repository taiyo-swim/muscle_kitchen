@extends('layouts.app')  <!--ユーザーのフォロワー一覧表示-->

@section('content')
<div class="container">
    <div class="follower_count">
            <p>{{ $user->name }}のフォロワー：{{ $follower_count }}人</p>
    </div>
    
    
    <div class="follower">
        @foreach ($followers as $follower)
        @if ($follower->id === $auth)  <!--フォロワーが自分のとき-->
            <h3 class="user_name"><a href="/my_page">{{ $follower->name }}</a></h3>
        @else  <!--フォロワーが自分ではないとき-->
            <h3 class="user_name"><a href="/users/{{ $follower->id }}">{{ $follower->name }}</a></h3>
        @endif
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $followers->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
        
    <div class="footer">
        <a href="/users/{{ $user->id }}">戻る</a>
    </div>
</div>
@endsection