@extends('layouts.app')

@section('content')

    <div class="recipe_review">
        <h3 class="review-title">{{ $recipe->title }}のレビューの投稿</h3>
            <form action="/recipes/{{ $recipe->id }}/create_review" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="review-form">
                        <h4>レビューを記入</h4>
                        <div class="review-stars">
                            <div class="evaluation">
                                <input id="star1" type="radio" name="review[stars]" value="5" />
                                <label for="star1"><span class="text">最高</span>★</label>
                                <input id="star2" type="radio" name="review[stars]" value="4" />
                                <label for="star2"><span class="text">良い</span>★</label>
                                <input id="star3" type="radio" name="review[stars]" value="3" />
                                <label for="star3"><span class="text">普通</span>★</label>
                                <input id="star4" type="radio" name="review[stars]" value="2" />
                                <label for="star4"><span class="text">悪い</span>★</label>
                                <input id="star5" type="radio" name="review[stars]" value="1" />
                                <label for="star5"><span class="text">最悪</span>★</label>
                            </div>
                            <p class="stars__error" style="color:red">{{ $errors->first('stars') }}</p>
                        </div>
                        <div class="review-comment">
                            <h4>コメント</h4>
                            <textarea name="review[comment]">{{ old('review.comment') }}</textarea>
                            <p class="comment__error" style="color:red">{{ $errors->first('comment') }}</p>
                        </div>
                        <button type="submit" class="btn btn-warning">登録する</button>
                    </div>
            </form>
        <div class="show_review">
            
            @foreach($recipeReviews as $recipeReview)
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
            
            <div class="delete">
                {{--@can('delete_review', $recipeReview) --}}
                    <form action="/recipes/{{ $recipeReview->id }}/review" id="review_delete" method="post">
                    @csrf
                    @method('DELETE')
                        <h5><span onclick="return deletePost(this);">削除</span></h5>
                    </form>
                {{--@endcan--}}
            </div>
            @endforeach
            
        </div>
    </div>
    
    <script>
        function deletePost(){
        'use strict';
            if (confirm("削除すると復元できません。\n本当に削除しますか？")) {
                document.getElementById("review_delete").submit();
            }
        }
    </script>
@endsection