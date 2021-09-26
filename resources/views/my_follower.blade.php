@extends('layouts.app')  <!--フォロワー一覧表示-->

@section('content')
<div class="container">
    <div class="follower_count">
            <p>{{ $auth->name }}のフォロワー：{{ $follower_count }}人</p>
    </div>
    
    
    <div class="follower">
        @foreach ($followers as $follower)  
            <h3 class="user_name"><a href="/users/{{ $follower->id }}">{{ $follower->name }}</a></h3>  <!--フォロワーの情報表示-->
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $followers->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
        
    <div class="footer">
        <a href="/my_page">戻る</a>
    </div>
</div>
@endsection