@extends('layouts.app')

@section('content')
        <div class="visualandText">
            <div id="mainvisual">
                <div class="mainvisual-left"><img src="ホームイメージ.jpg" alt=""></div>
                <div class="mainvisual-right"><img src="ホームイメージ2.jpeg" alt=""></div>
            </div>
        
            <div class="maintext">
                <h1>--Muscle Kitchen--</h1>
                
                <p>
                    筋トレをしている人のためのタンパク質の多い料理を扱うレシピサイトです。<br>
                    筋肉をつけたい人、ダイエットをしたい人などが日頃の食事の参考になるようなレシピを共有するサイトですので<br>
                    是非ともご活用ください！
                </p>
            </div>
        </div>
    
        <div class="search">
            <!--↓↓ 検索フォーム ↓↓-->
                <form  class="search-form" method="get" action="/search">
                @csrf
                    <input type="text" name="keyword" class="search-box" placeholder="料理名、食材名">
                    <button type="submit" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            <!--↑↑ 検索フォーム ↑↑-->
        </div>

        <div class='home-recipes'>
            @foreach ($recipes as $recipe)
                <div class='home-recipe'>
                    <a href="/recipes/{{ $recipe->id }}">
                        @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                            <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" />  <!--レシピの画像表示-->
                        @else
                            <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                        @endif
                        <div class="home-recipe-text">
                            <h5 class='title'>{{ $recipe->title }}</h2>  <!--レシピのタイトル表示-->
                            <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class='home-paginate'>
                <div class='paginate'>
                    {{ $recipes->links() }}  <!--ぺジネーションのリンクを追加-->
                </div>
        </div>
@endsection
