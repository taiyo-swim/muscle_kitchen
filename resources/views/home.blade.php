@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        [<a href='/recipes/create'>レシピ投稿</a>]  <!--レシピ投稿ボタン設置-->
    </div>
    
    <!--↓↓ 検索フォーム ↓↓-->
    <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
        <form class="form-inline" method="get" action="/search">
        @csrf
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="料理名、食材名">
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
    </div>
    <!--↑↑ 検索フォーム ↑↑-->

    <div class='recipes'>
        @foreach ($recipes as $recipe)
            <div class='recipe'>
                <h2 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                <img src="{{ asset('/storage/'.$recipe->image)}}" />  <!--レシピの画像表示-->
                <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
            </div>
        @endforeach
    </div>
    
    <div class='paginate'>
            {{ $recipes->links() }}  <!--ぺジネーションのリンクを追加-->
    </div>
</div>
@endsection
