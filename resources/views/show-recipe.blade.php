@extends('layouts.app')

@section('content')
        <div class="show-recipe">
                
            <div class="recipe-information">      
                <div class="show-title">
                    <h3>{{ $recipe->title }}</h3>
                            <div class="nice">
                                <span>
                                    <i class="fas fa-heart fa-fw fa-lg my-red faa-pulse animated" style="color: #ce5242"></i>
                                     
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
                            </div>
                </div>
                
                <div class="show-user_name">
                    @if($recipe->user->id === $auth->id)
                        <h5><a href="/my_page">by {{ $recipe->user->name }}</a></h5>  <!--自分の投稿したレシピの場合はマイページへ-->
                    @else
                        <h5><a href="/users/{{ $recipe->user->id }}">{{ $recipe->user->name }}</a></h5> <!--それ以外の場合はユーザーページへ-->
                    @endif
                </div>
                
                <p class="show-explanation">
                    {{ $recipe->explanation }}
                </p>
                
                <div class="recipe-button">
                    <div class="edit">
                        @can('update', $recipe)  <!--投稿したユーザー以外には表示されない-->
                            <h5><a href="/recipes/{{ $recipe->id }}/edit">編集</a></h5>
                        @endcan
                    </div>
                    <div class="delete">
                        @can('delete', $recipe)  <!--投稿したユーザー以外には表示されない-->
                            <form action="/recipes/{{ $recipe->id }}" id="form_delete" method="post">
                                @csrf
                                @method('DELETE')
                                <h5><span onclick="return deletePost(this);">削除</span></h5>
                            </form>
                        @endcan
                    </div>
                </div>
                
                
                    
                 <div class="tags">
                    @foreach ($recipe->tags as $recipe_tag)  
                    <form method="get" action="/tag_search">  <!--タグボタンを押したらそのタグを有するレシピを表示する検索機能-->
                        @csrf
                        <input type="hidden" name="tag_keyword" value="{{ $recipe_tag->name }}"/>
                        <button type="submit">{{ $recipe_tag->name }}</button>
                    </form>
                    @endforeach
                </div>
                
            </div> 
            
            <div class="image">
            @if ($recipe->image_path)
                <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" width="400 height="300/>
            @else
                <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
            @endif
            </div>
            <div class="cook-recipe">
                <div class="ingredients">
                    <h4><i class="fa fa-arrow-circle-right"></i> 食材({{ $recipe->serving }}人前)</h4>
                    <div class="ingredients-detail">
                        <p>{!! nl2br(htmlspecialchars($recipe->ingredients)) !!}</p>
                        <p>{!! nl2br(htmlspecialchars($recipe->amount_of_ingredients)) !!}</p>
                    </div>
                </div>
                <div class="how_to_cook">
                    <h4><i class="fa fa-arrow-circle-right"></i> 作り方</h4>
                    <p>・{!! nl2br(htmlspecialchars( $recipe->how_to_cook)) !!}</p>
                </div>
            </div>
                    
            <div class="point">
                <h4><i class="fa fa-arrow-circle-right"></i> ポイント</h4>
                <p>{{ $recipe->point }}</p>
            </div>
        </div>
        
        <div class="back">
            <a href="/recipes/{{ $recipe->id }}">戻る</a>
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