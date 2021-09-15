@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class='recipes'>
        @foreach ($recipes as $recipe)
            <div class='recipe'>
                <h2 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                    <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" width="300 height="200/>  <!--レシピの画像表示-->
                @endif
                <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
            </div>
        @endforeach
    </div>
</div>
@endsection