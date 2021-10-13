@extends('layouts.app')  <!--フォロー一覧表示-->

@section('content')
<div class="following_list">
    <div id="following-title" class="follow_count">
            <h4>{{ $auth->name }}のフォロー：{{ $follow_count }}人</h4>
    </div>
    
    
    <div id="following-users">
        @foreach ($follows as $follow)
            <div id="following-user" class="user_follow">
                <h4 class="user_name"><a href="/users/{{ $follow->id }}">{{ $follow->name }}</a></h4>  <!--フォロワーの情報表示-->
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $follows->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
</div>
@endsection