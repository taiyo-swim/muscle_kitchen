@extends('layouts.app')  <!--ユーザーのフォロー一覧表示-->

@section('content')
<div class="container">
    <div class="follow_count">
            <p>{{ $user->name }}のフォロー：{{ $follow_count }}人</p>
    </div>
    
    
    <div class="follow">
        @foreach ($follows as $follow)
        @if ($follow->id === $auth)  <!--フォローが自分のとき-->
            <h3 class="user_name"><a href="/my_page">{{ $follow->name }}</a></h3>
        @else  <!--フォローが自分ではないとき-->
            <h3 class="user_name"><a href="/users/{{ $follow->id }}">{{ $follow->name }}</a></h3>
        @endif
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $follows->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
        
    <div class="footer">
        <a href="/users/{{ $user->id }}">戻る</a>
    </div>
</div>
@endsection