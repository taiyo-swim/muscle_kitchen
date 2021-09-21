@extends('layouts.app')  <!--自分が投稿したレシピを表示-->

@section('content')
<div class="container">
    
    <div class="header">
            <h2>マイレシピ：{{ $count }}品</p>
    </div>
    
    
    <div class='recipes'>
        @foreach ($my_recipes as $my_recipe)
            <div class='recipe'>
                <h2 class='title'><a href="/recipes/{{ $my_recipe->id }}">{{ $my_recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                @if ($my_recipe->image_path)  <!--画像がアップロードされている時-->
                    <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $my_recipe->image_path }}" width="300 height="200/>  <!--レシピの画像表示-->
                @endif
                <p class='explanation'>{{ $my_recipe->explanation }}</p>  <!--レシピの説明表示-->
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
            {{ $my_recipes->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
</div>
@endsection