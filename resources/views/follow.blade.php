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
                <h3 class="user_name"><a href="/my_page">{{ $follow->name }}</a></h3>
            @else  <!--フォローが自分ではないとき-->
                <h3 class="user_name"><a href="/users/{{ $follow->id }}">{{ $follow->name }}</a></h3>
            @endif
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $follows->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
</div>
@endsection