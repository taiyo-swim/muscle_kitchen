@extends('layouts.app')  <!--該当ユーザーのレシピ一覧を表示-->

@section('content')
    <div class="container">
        <div class="user_name">
            <p>{{ $user_name }}のレシピ：{{ $count }}品</p>
        </div>
        
        @foreach ($recipes as $recipe)
            <div class="user_recipe">
                <h2 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                    <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" width="300 height="200/>  <!--レシピの画像表示-->
                @endif
                <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
            </div>
        @endforeach
        
        
        <div class='paginate'>
                {{ $recipes->links() }}  <!--ぺジネーションのリンクを追加-->
        </div>
        
        <div class="footer">
            <a href="/home">戻る</a>
        </div>
   </div>     


@endsection