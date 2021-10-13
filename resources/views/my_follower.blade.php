@extends('layouts.app')  <!--フォロワー一覧表示-->

@section('content')
<div class="following_list">
    <div id="following-title" class="follower_count">
            <h4>{{ $auth->name }}のフォロワー：{{ $follower_count }}人</h4>
    </div>
    
    
    <div id="following-users">
        @foreach ($followers as $follower)
            <div id="following-user" class="user_follower">
                <h4 class="user_name"><a href="/users/{{ $follower->id }}">{{ $follower->name }}</a></h4>  <!--フォロワーの情報表示-->
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $followers->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
</div>
@endsection