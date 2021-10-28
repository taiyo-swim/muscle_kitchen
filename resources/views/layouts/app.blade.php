<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Muscle Kitchen') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('/js/create_recipe.js') }}"></script>
    


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search-recipe.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/following.css') }}" rel="stylesheet">
    <link href="{{ asset('css/recipe-review.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="nav-item">
            <div class="container">
                <h2 class="navbar-brand" style="font-family: 'Sawarabi Mincho', sans-serif; font-weight: bold; text-shadow: 2px 2px 1px #bbb;">
                    Muscle Kitchen
                </h2>
                
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">-->
                <!--    <span class="navbar-toggler-icon"></span>-->
                <!--</button>-->
                
                
                <div id="mobile-size">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown" id="nav-item" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 2px 2px 1px #bbb;">
                            <a id="navbarDropdown" class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            メニュー
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/">
                                    ホーム
                                </a>    
                                <a class="dropdown-item" href="/my_page">
                                    マイページ
                                </a>
                                <a class="dropdown-item" href="/recipes/create">
                                    レシピ投稿
                                </a>
                                <a id="navbarDropdown" class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    レシピ
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/search">
                                        <i class="fa fa-search" aria-hidden="true"></i> レシピ検索 
                                    </a>    
                                    
                                    <a class="dropdown-item" href="/search_by_nicecount">
                                        いいねの多いレシピ
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div id="mobile-size">
                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 1px 1px 1px #bbb;"><i class="fas fa-sign-in-alt"></i> {{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 1px 1px 1px #bbb;"><i class="fas fa-user-plus"></i> {{ __('ユーザー登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 1px 1px 1px #bbb;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->image_path)
                                        <img id="home-user-image" src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ Auth::user()->image_path }}"/>
                                    @else
                                        <img id="home-user-image" src="{{asset('defaultuser.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                                    @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="/my_page/edit_user">
                                        {{ __('ユーザー情報編集') }}
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                </ul>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                
                    <!-- Left Side Of Navbar -->
                <div id="pc-size"> 
                    <ul class="navbar-nav mr-auto" style="margin: 0 150px; font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 2px 2px 1px #bbb;">
                        <li><a class="dropdown-item" href="/" style="border-right: solid;">
                            <i class="fa fa-home faa-tada animated-hover" aria-hidden="true"></i> ホーム
                        </a></li>
                        <li><a class="dropdown-item" href="/my_page" style="border-right: solid;">
                            マイページ
                        </a></li>
                        <li><a class="dropdown-item" href="/recipes/create" style="border-right: solid;">
                            レシピ投稿
                        </a></li>
                        <li class="nav-item dropdown" id="navbar-recipe">
                            <a id="navbarDropdown" class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                レシピ
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/search">
                                    <i class="fa fa-search" aria-hidden="true"></i> レシピ検索 
                                </a>    
                                
                                <a class="dropdown-item" href="/search_by_nicecount">
                                    いいねの多いレシピ
                                </a>
                            </div>
                        </li>               
                    </ul>
                
                </div>
                                
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 1px 1px 1px #bbb;"><i class="fas fa-sign-in-alt"></i> {{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 1px 1px 1px #bbb;"><i class="fas fa-user-plus"></i> {{ __('ユーザー登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="font-family: 'Sawarabi Mincho', sans-serif; text-shadow: 1px 1px 1px #bbb;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->image_path)
                                        <img id="home-user-image" src="https://muscle-kitchen.s3.ap-northeast-1.amazonaws.com/{{ Auth::user()->image_path }}"/>
                                    @else
                                        <img id="home-user-image" src="{{asset('defaultuser.png')}}" style="filter: grayscale(100%);">  <!--デフォルトの画像-->
                                    @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="/my_page/edit_user">
                                        {{ __('ユーザー情報編集') }}
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
        <footer id="footer">
            <ul class="footer-link">
                <li><a href="/">ホーム</a></li>
                <li><a href="/my_page">マイページ</a></li>
            </ul>
            <p class="footer-text"><br>2021 Muscle Kitchen created by Taiyo.Yamamoto</p>
        </footer>
        
    </div>
    <script src="{{ asset('/js/app.js') }}" defer></script>
    
    <style>
        #home-user-image {
            object-fit: cover;
            object-position: center top;
            float: left;
            margin: 0 5px 5px 0; 
            border-radius: 50%; 
            width: 30px; 
            height: 30px;
        }
        
        #nav-item a:hover {
            background-color: #ffffcc;
            color: black;
        }
        
        #nav-item a:focus {
            background-color: white;
            color: black;
            text-shadow: 0 0 0;
        }
        
        #navbar-recipe a:focus {
            color: #ffcc33;
        }
        
        #mobile-size {
            display: none;
        }
        
        @media screen and (max-width: 480px) {
            #pc-size {
                display: none;
            }
            
            #mobile-size {
                display: inline;
            }
        }
    </style>
</body>
</html>
