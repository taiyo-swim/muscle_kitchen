@extends('layouts.app')  <!--該当ユーザーのレシピ一覧を表示-->

@section('content')
        <div class="search-keyword" style="color: white; font-weight: bold; font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 2px 2px 1px black;">
            <h2>{{ $user->name }}のレシピ：{{ $count }}品</h2>
        </div>
        
        <div class='search-recipes'>
            @foreach ($recipes as $recipe)
                <div class="search-recipe">
                    @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                        <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" width="300 height="200/>  <!--レシピの画像表示-->
                    @else
                        <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                    @endif
                    <div class="search-recipe-text">
                        <h2 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                        <div class="user_name">
                            @if($recipe->user->id === $auth->id)
                                <a href="/my_page">by {{ $recipe->user->name }}</a>  <!--自分の投稿したレシピの場合はマイページへ-->
                            @else
                                <a href="/users/{{ $recipe->user->id }}">by {{ $recipe->user->name }}</a>  <!--それ以外の場合はユーザーページへ-->
                            @endif
                        </div>
                        <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
                    </div>
                </div>
            @endforeach
        </div>
        
        
        <div class='paginate'>
                {{ $recipes->links() }}  <!--ぺジネーションのリンクを追加-->
        </div>
@endsection