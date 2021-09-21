<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Nice;
use Illuminate\Support\Facades\Auth;

class My_pageController extends Controller
{
    public function index()  //ユーザーの情報を表示
    {
        $auth = Auth::user();  //ログインユーザー情報を取得
        $recipes = Recipe::whereIn('user_id', $auth)->orderBy('created_at', 'desc')->get();  //該当IDのユーザー(ログインユーザー)のレシピを取得
        
        return view('my_page')->with(['my_user' => $auth, 'recipes' => $recipes]);
    }
    
    public function show_my_recipe()  //自分が投稿したレシピの表示
    {
        $user_id = Auth::id();  //ログインユーザー情報を取得
        $my_recipes = Recipe::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(10);  //該当IDのユーザー(ログインユーザー)のレシピを取得
        $count = count($my_recipes);
        
        return view('my_recipe')->with(['my_recipes' => $my_recipes, 'count' => $count]);
    }
    
    public function show_nice_recipe()  //いいねしたレシピを表示
    {
        $user_id = Auth::id();  //ログインユーザーのIDを取得
        //ログインユーザーのIDと等しいnicesテーブルのuser_idを探し、そのuser_idを持つレコードのrecipe_idのみを取得
        $nice = Nice::where('user_id', $user_id)->select('recipe_id')->get();  //$niceには複数のレコードのrecipe_idが入っているため、データは配列
        //そのnicesテーブルのrecipe_idでrecipesテーブルに検索をかける
        $nice_recipes = Recipe::whereIn('id', $nice)->orderBy('created_at', 'desc')->paginate(10);  //$niceのデータが配列のためwhereInを使う
        $count = count($nice_recipes);
        return view('my_nice_recipe')->with(['nice_recipes' => $nice_recipes, 'count' => $count]);
    }
}
