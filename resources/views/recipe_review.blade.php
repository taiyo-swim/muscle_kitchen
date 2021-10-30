@extends('layouts.app')

@section('content')

    <div class="recipe_review">
        <div class="review-title">
            @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" />  <!--レシピの画像表示-->
            @else
                <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
            @endif
            <h2><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a>のレビュー（{{ $review_count }}件）</h2>
        </div>
        
            <form action="/recipes/{{ $recipe->id }}/create_review" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="review-form">
                        <div class="review-board">
                            <h5><i class="fas fa-angle-right"></i> レビューを記入</h5>
                            <div class="review-stars">
                                <div class="evaluation">
                                    <input id="star1" type="radio" name="review[stars]" value="5" />
                                    <label for="star1"><span class="text"></span>★</label>
                                    <input id="star2" type="radio" name="review[stars]" value="4" />
                                    <label for="star2"><span class="text"></span>★</label>
                                    <input id="star3" type="radio" name="review[stars]" value="3" />
                                    <label for="star3"><span class="text"></span>★</label>
                                    <input id="star4" type="radio" name="review[stars]" value="2" />
                                    <label for="star4"><span class="text"></span>★</label>
                                    <input id="star5" type="radio" name="review[stars]" value="1" />
                                    <label for="star5"><span class="text"></span>★</label>
                                </div>
                                <p class="stars__error" style="color:red">{{ $errors->first('stars') }}</p>
                            </div>
                            <div class="review-comment">
                                <h5><i class="fas fa-angle-right"></i> コメント</h5>
                                <textarea name="review[comment]">{{ old('review.comment') }}</textarea>
                                <p class="comment__error" style="color:red">{{ $errors->first('comment') }}</p>
                            </div>
                            <div class="review-button">
                                @if($exist_review === null)
                                    <button type="submit">投稿</button>
                                @else
                                    @if($exist_review->user_id == $auth_id)  <!--ユーザーがすでにレビューを投稿している場合はボタンを押せないように-->
                                        <button disabled>既に投稿済みです</button>
                                    @else
                                        <button type="submit">投稿</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
            </form>
        <div class="show_reviews">
            <ul class="review-list">
                @foreach($recipeReviews as $recipeReview)
                <li><div class="show_review">
                    <div class="review_user_name">
                        <p>{{ $recipeReview->user->name }}</p>
                    </div>
                    <div class="show-review-stars">
                        @if ($recipeReview->stars == 1)
                            <p>{{ '⭐️' }}</p>
                        @elseif ($recipeReview->stars == 2)
                            <p>{{ '⭐️⭐️' }}</p>
                        @elseif ($recipeReview->stars == 3)
                            <p>{{ '⭐️⭐️⭐️' }}</p>
                        @elseif ($recipeReview->stars == 4)
                            <p>{{ '⭐️⭐️⭐️⭐️' }}</p>
                        @elseif ($recipeReview->stars == 5)
                            <p>{{ '⭐️⭐️⭐️⭐️⭐️' }}</p>
                        @endif
                    </div>
                
                    <div class="show-review-comment">
                        <p>{{ $recipeReview->comment }}</p>
                    </div>
                    <div class="show-review-day">
                        <p>{{ $recipeReview->created_at }}</p>
                    </div>
                    
                    <div class="delete delete-review-button">
                        @if($recipeReview->user_id == $auth_id)  <!-- レビューを投稿したユーザーのみ削除可能 -->
                            <form action="/recipes/{{ $recipeReview->id }}/review" id="review_delete" method="post">
                            @csrf
                            @method('DELETE')
                                <span onclick="return deletePost(this);">削除</span>
                            </form>
                        @endif
                    </div>
                </div></li>
                @endforeach
            </ul>
            <p class="review-add">
                <a href="#" class="open-btn">もっと見る</a>
            </p>
                        
        </div>
    </div>
    
    <script>
        function deletePost(){
        'use strict';
            if (confirm("削除すると復元できません。\n本当に削除しますか？")) {
                document.getElementById("review_delete").submit();
            }
        }
        
        
        window.addEventListener('DOMContentLoaded', function(){  //レビューのもっと見るボタンの処理
          var hideList = '.review-list li:nth-of-type(n+2)';  //2つ目以降のリストを非表示
          $(hideList).hide();
          $('.open-btn').click(function() {
            $(hideList).toggle();
            if ($(hideList).css('display') == 'none') {
              $('.open-btn').text('もっと見る');
            } else {
              $('.open-btn').text('閉じる');
            }
            return false;
          });
          var num = $('.review-list').children('li').length;  //リストが1つしかなければ表示しない
          if (num < 2) {
            $('.open-btn').hide();
          };
        });
  
    </script>
@endsection