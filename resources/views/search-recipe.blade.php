@extends('layouts.app')

@section('content')
        <div class="search">
            <form class="search-form" method="get" action="/search">
            @csrf
                <input type="text" name="keyword" class="search-box" placeholder="料理名、食材名">
                <button type="submit" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        
        <div class="search-keyword">
            @if ($keyword != null)
                <h5>{{ $keyword }}の検索結果一覧：{{ $count }}品</h5>
            @endif
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
                        <div class="recipe-title-nice">
                            <h3 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h3>  <!--レシピのタイトル表示-->
                            <h5 class="cooktimes"><span  style="color: #6699ff;"><i class="fas fa-clock"></i> {{ $recipe->cooktimes }}分</span></h5>
                            <div class="search-nice">
                                @if(Auth::user() === null)
                                <p class="favorite-marke">
                                    <a href="/login" style="color: #dddddd; font-size: 1.3em;"><i class="fas fa-heart"></i></a>
                                    <span class="nicesCount">{{$recipe->nices_count}}</span>
                                </p>
                                @elseif($nice_model->nice_exist(Auth::user()->id, $recipe->id))
                                <p class="favorite-marke">
                                    <a class="js-nice-toggle loved" href="" data-recipeid="{{ $recipe->id }}" style="font-size: 1.3em; color: #dddddd;"><i class="fas fa-heart"></i></a>
                                    <span class="nicesCount">{{$recipe->nices_count}}</span>
                                </p>
                                @else
                                <p class="favorite-marke">
                                    <a class="js-nice-toggle" href="" data-recipeid="{{ $recipe->id }}" style="color: #dddddd; font-size: 1.3em;"><i class="fas fa-heart"></i></a>
                                    <span class="nicesCount">{{$recipe->nices_count}}</span>
                                </p>
                                @endif​ 
                            </div>
                        </div>
                        <div class="user_name">
                            @if($auth === null)
                                <a href="/login">by {{ $recipe->user->name }}</a>
                            @elseif($recipe->user_id === $auth->id)
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