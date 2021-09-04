@extends('layouts.app')

@section('content')
    <div class="recipe">
        <h1 class="title">
            {{ $recipe->title }}
        </h1>
        <div class="image">
        <p><img src="{{ asset('/storage/'.$recipe->image)}}"/></p>
        </div>
        <div class="tags">
        @foreach ($recipe->tags as $recipe_tag)
            <span class="badge badge-pill badge-info">{{ $recipe_tag->name }}</span>
        @endforeach
        </div>
        <p class="explanation">
            {{ $recipe->explanation }}
        </p>
        <div class="ingredients">
            <h2>食材</h2>
            {{ $recipe->ingredients }}
        </div>
        <div class="how_to_cook">
            <h2>作り方</h2>
            {{ $recipe->how_to_cook }}
        </div>
        <div class="point">
            <h2>ポイント</h2>
            {{ $recipe->point }}
        </div>
    </div>
    
    <div class="footer">
        <a href="/home">戻る</a>
    </div>
    
@endsection