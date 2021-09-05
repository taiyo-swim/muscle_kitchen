@extends('layouts.app')

@section('content')
    <div class="header">
        <p class="edit">[<a href="/recipes/{{ $recipe->id }}/edit">編集</a>]</p>
        <form action="/recipes/{{ $recipe->id }}" id="form_delete" method="post">
            @csrf
            @method('DELETE')
            <p class="delete">[<span onclick="return deletePost(this);">削除</span>]</p>
        </form>
        </form>
    </div>
    
    <div class="recipe">
        <h1 class="title">
            {{ $recipe->title }}
        </h1>
        <p class="user_name">{{ $recipe->user->name }}</p>
         <div class="tags">
        @foreach ($recipe->tags as $recipe_tag)
            <span class="badge badge-pill badge-info">#{{ $recipe_tag->name }}</span>
        @endforeach
        </div>
        <div class="image">
        <p><img src="{{ asset('/storage/'.$recipe->image)}}"/></p>
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
    
    <script>
        function deletePost(){
        'use strict';
            if (confirm("削除すると復元できません。\n本当に削除しますか？")) {
                document.getElementById("form_delete").submit();
            }
        }
    </script>
    
@endsection