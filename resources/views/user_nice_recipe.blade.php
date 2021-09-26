@extends('layouts.app')  <!--ユーザーがいいねしたレシピを表示-->

@section('content')
<div class="container">
    
    <div class="header">
            <h2>{{ $user->name }}いいねしたレシピ：{{ $count }}品</p>
    </div>
    
    
    <div class='recipes'>
        @foreach ($nice_recipes as $nice_recipe)
            <div class='recipe'>
                <h2 class='title'><a href="/recipes/{{ $nice_recipe->id }}">{{ $nice_recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                @if ($nice_recipe->image_path)  <!--画像がアップロードされている時-->
                    <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $nice_recipe->image_path }}" width="300 height="200/>  <!--レシピの画像表示-->
                @endif
                <p class='explanation'>{{ $nice_recipe->explanation }}</p>  <!--レシピの説明表示-->
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
        {{ $nice_recipes->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
        
    <div class="footer">
        <a href="/users/{{ $user->id }}">戻る</a>
    </div>
    
</div>
@endsection