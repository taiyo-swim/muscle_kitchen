@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class='recipes'>
        @foreach ($recipes as $recipe)
            <div class='recipe'>
                <h2 class='title'><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h2>  <!--レシピのタイトル表示-->
                <img src="{{ asset('/storage/'.$recipe->image)}}" />  <!--レシピの画像表示-->
                <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
            </div>
        @endforeach
    </div>
</div>
@endsection