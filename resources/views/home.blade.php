@extends('layouts.app')

@section('content')
        <div class="visualandText">
            <div id="mainvisual">
                <div class="mainvisual-left"><img src="ホームイメージ.jpg" alt=""></div>
                <div class="mainvisual-right"><img src="ホームイメージ2.jpeg" alt=""></div>
            </div>
        
            <div class="maintext">
                <h1>--Muscle Kitchen--</h1>
                
                <p>
                    筋トレをしている人のためのタンパク質の多い料理を扱うレシピサイトです。<br>
                    筋肉をつけたい人、ダイエットをしたい人などが日頃の食事の参考になるようなレシピを共有するサイトですので<br>
                    是非ともご活用ください！
                </p>
            </div>
        </div>
    
        <div class="search">
            <!--↓↓ 検索フォーム ↓↓-->
                <form  class="search-form" method="get" action="/search">
                @csrf
                    <input type="text" name="keyword" class="search-box" placeholder="料理名、食材名">
                    <button type="submit" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            <!--↑↑ 検索フォーム ↑↑-->
        </div>
        
        <div class="click-search">
            <div class="switch-button">
                <input id="ingredient-cateogry" type="radio" name="recipe_item" checked="checked">
                <label class="recipe_item ingredient_title" for="ingredient-cateogry" style="margin-right: 20px;"><h4>食材から探す</h4></label>
                <input id="menue-cateogry" type="radio" name="recipe_item">
                <label class="recipe_item menue_title" for="menue-cateogry"><h4>料理から探す</h4></label>
            </div>
            
            <div id="ingredient-recipe-cateogry" style="display: block;">
                <ul class="search-item">
                    <li class="item-meat" id="item-detail">
                        <p>お肉料理</p>
                        <ul>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="鶏むね肉"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">鶏むね肉</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="鶏もも肉"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">鶏もも肉</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="牛肉"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">牛肉</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="豚肉"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">豚肉</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="ひき肉"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">ひき肉</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="ハム"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">ハム</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="item-vegetable" id="item-detail">
                        <p>野菜料理</p>
                        <ul>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="ブロッコリー"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">ブロッコリー</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="アボカド"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">アボカド</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="大豆"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">大豆</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="オクラ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">オクラ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="ほうれん草"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">ほうれん草</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="item-fish" id="item-detail">
                        <p>魚介料理</p>
                        <ul>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="鮭・サーモン"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">鮭・サーモン</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="マグロ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">マグロ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="サバ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">サバ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="サンマ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">サンマ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="イワシ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">イワシ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="アジ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">アジ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="タコ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">タコ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="エビ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">エビ</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="イカ"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">イカ</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="item-exet" id="item-detail">
                        <p>その他の材料</p>
                        <ul>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="プロテイン"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">プロテイン</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search">  
                                    @csrf
                                    <input type="hidden" name="keyword" value="豆腐"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">豆腐</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="オートミール"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">オートミール</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="卵"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">卵</button>
                                </form>
                            </li>
                            <li>
                                <form method="get" action="/search"> 
                                    @csrf
                                    <input type="hidden" name="keyword" value="納豆"/>
                                    <i class="fas fa-angle-right"></i> <button type="submit">納豆</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div id="menu-recipe-cateogry" style="display: none;">
                <div id="item-detail">
                    <ul class="search-item" style="background-color: #ffdbc9;">
                        <li>
                            <form method="get" action="/search">  
                                @csrf
                                <input type="hidden" name="keyword" value="和食"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">和食</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search">  
                                @csrf
                                <input type="hidden" name="keyword" value="中華"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">中華</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="洋食"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">洋食</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="イタリアン"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">イタリアン</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="デザート"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">デザート</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="丼物"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">丼物</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="スープ・汁物"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">スープ・汁物</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="サラダ"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">サラダ</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="うどん・そば"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">うどん・そば</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="パスタ"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">パスタ</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="飲み物"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">飲み物</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="パン"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">パン</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="鍋"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">鍋</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="餅"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">餅</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="唐揚げ"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">唐揚げ</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="ステーキ"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">ステーキ</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="カレー"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">カレー</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="親子丼"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">親子丼</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="卵焼き"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">卵焼き</button>
                            </form>
                        </li>
                        <li>
                            <form method="get" action="/search"> 
                                @csrf
                                <input type="hidden" name="keyword" value="パンケーキ"/>
                                <i class="fas fa-angle-right"></i> <button type="submit" style="background-color: #ffdbc9;">パンケーキ</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
                    
        <div class='home-recipes'>
            @foreach ($recipes as $recipe)
                <div class='home-recipe'>
                    <a href="/recipes/{{ $recipe->id }}">
                        @if ($recipe->image_path)  <!--画像がアップロードされている時-->
                            <img src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ $recipe->image_path }}" />  <!--レシピの画像表示-->
                        @else
                            <img src="{{asset('cooking_frying_pan01_01.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                        @endif
                        <div class="home-recipe-text">
                            <h5 class='title'>{{ $recipe->title }}</h2>  <!--レシピのタイトル表示-->
                            <p class='explanation'>{{ $recipe->explanation }}</p>  <!--レシピの説明表示-->
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class='home-paginate'>
                <div class='paginate'>
                    {{ $recipes->links() }}  <!--ぺジネーションのリンクを追加-->
                </div>
        </div>
        
    <script>
     window.addEventListener('DOMContentLoaded', function()
        {
            $('input[name="recipe_item"]').change(function() {
                var result = $(this).attr('id');
                if (result == 'ingredient-cateogry') {
                    document.getElementById('menu-recipe-cateogry').style.display = 'none' //非表示
                    document.getElementById('ingredient-recipe-cateogry').style.display = 'block' //表示
                }
                else {
                    document.getElementById('ingredient-recipe-cateogry').style.display = 'none'
                    document.getElementById('menu-recipe-cateogry').style.display = 'block'
                }
            });
        });
    </script>
@endsection
