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
        <span>
        <img src="{{asset('nicebutton.png')}}" width="30px">
         
        <!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
        @if($nice)
        <!-- 「いいね」取消用ボタンを表示 -->
        	<a href="/recipes/unnice/{{ $recipe->id }}" class="btn btn-success btn-sm">
        		いいね
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $recipe->nices->count() }}
        		</span>
        	</a>
        @else
        <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
        	<a href="/recipes/nice/{{ $recipe->id }}" class="btn btn-secondary btn-sm">
        		いいね
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $recipe->nices->count() }}
        		</span>
        	</a>
        @endif
        </span>
                
        <h1 class="title">
            {{ $recipe->title }}
        </h1>
        <p class="user_name">{{ $recipe->user->name }}</p>
         <div class="tags">
        @foreach ($recipe->tags as $recipe_tag)  
        <form method="get" action="/tag_search">  <!--タグボタンを押したらそのタグを有するレシピを表示する検索機能-->
            @csrf
            <input type="hidden" name="tag_keyword" value="{{ $recipe_tag->name }}"/>
            <button  class="badge badge-pill badge-info" type="submit">#{{ $recipe_tag->name }}</button>
        </form>
        @endforeach
        </div>
        <div class="image">
        @if ($recipe->image_path)
            <p><img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" width="400 height="300/></p>
        @endif
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