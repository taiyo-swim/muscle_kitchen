@extends('layouts.app')  <!--フォロー一覧表示-->

@section('content')
<div class="container">
    <div class="follow_count">
            <p>{{ $auth->name }}のフォロー：{{ $follow_count }}人</p>
    </div>
    
    
    <div class="follow">
        @foreach ($follows as $follow)
            <h3 class="user_name"><a href="/users/{{ $follow->id }}">{{ $follow->name }}</a></h3>  <!--フォローしているユーザーの情報表示-->
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $follows->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
        
    <div class="footer">
        <a href="/my_page">戻る</a>
    </div>
</div>
@endsection