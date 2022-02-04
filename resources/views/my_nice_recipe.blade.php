@extends('layouts.app')  <!--自分がいいねしたレシピを表示-->

@section('content')
    <div class="search-keyword" style="color: white; font-weight: bold; font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 2px 2px 1px black;">
            <h3>いいねしたレシピ：{{ $count }}品</h3>
    </div>
    
    
    <div class='search-recipes'>
        @foreach ($nice_recipes as $nice_recipe)
            <div class='search-recipe'>
                @if ($nice_recipe->image_path)  <!--画像がアップロードされている時-->
                    <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $nice_recipe->image_path }}"/>  <!--レシピの画像表示-->
                @else
                    <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                @endif
                <div class="search-recipe-text">
                    <div class="recipe-title-nice">
                        <h3 class='title'><a href="/recipes/{{ $nice_recipe->id }}">{{ $nice_recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                        <h5 class="cooktimes"><span  style="color: #6699ff;"><i class="fas fa-clock"></i> {{ $nice_recipe->cooktimes }}分</span></h5>
                        <div class="nice">
                            @if($nice_model->nice_exist(Auth::user()->id, $nice_recipe->id))
                                <p class="favorite-marke">
                                    <a class="js-nice-toggle loved" href="" data-recipeid="{{ $nice_recipe->id }}" style="font-size: 1.3em; color: #dddddd;"><i class="fas fa-heart"></i></a>
                                    <span class="nicesCount">{{$nice_recipe->nices_count}}</span>
                                </p>
                            @else
                                <p class="favorite-marke">
                                    <a class="js-nice-toggle" href="" data-recipeid="{{ $nice_recipe->id }}" style="color: #dddddd; font-size: 1.3em;"><i class="fas fa-heart"></i></a>
                                    <span class="nicesCount">{{$nice_recipe->nices_count}}</span>
                                </p>
                            @endif​ 
                        </div>
                    </div>
                    <div class="user_name">
                        @if($nice_recipe->user->id === $auth->id)
                            <a href="/my_page">by {{ $nice_recipe->user->name }}</a>  <!--自分の投稿したレシピの場合はマイページへ-->
                        @else
                            <a href="/users/{{ $nice_recipe->user->id }}">by {{ $nice_recipe->user->name }}</a>  <!--それ以外の場合はユーザーページへ-->
                        @endif
                    </div>
                    <p class='explanation'>{{ $nice_recipe->explanation }}</p>  <!--レシピの説明表示-->
                </div>
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
            {{ $nice_recipes->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>

@endsection