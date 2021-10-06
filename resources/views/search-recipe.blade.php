@extends('layouts.app')

@section('content')
<body>
    <main>
        <div class="search">
            <form class="search-form" method="get" action="/search">
            @csrf
                <input type="text" name="keyword" class="search-box" placeholder="料理名、食材名">
                <button type="submit" class="search-button">検索</button>
            </form>
        </div>
        
        <div class="search-keyword">
                <h5>{{ $keyword }}の検索結果一覧：{{ $count }}品</h5>
        </div>
        
        
        <div class='search-recipes'>
            @foreach ($recipes as $recipe)
                <div class='search-recipe'>
                    @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                        <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}"/>  <!--レシピの画像表示-->
                    @else
                        <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                    @endif
                    <div class="search-recipe-text">
                        <h3 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                        <div class="user_name">
                            @if($recipe->user_id === $auth)
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
    </main>
</body>
@endsection