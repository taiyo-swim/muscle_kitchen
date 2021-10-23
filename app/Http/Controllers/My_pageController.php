<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Nice;
use Illuminate\Support\Facades\Auth;
use App\FollowUser;
use App\User;
use Illuminate\Support\Facades\Storage;

class My_pageController extends Controller
{
    public function index()  //ユーザーの情報を表示
    {
        $auth = Auth::user();  //ログインユーザー情報を取得
        $recipes = Recipe::where('user_id', $auth)->orderBy('created_at', 'desc')->get();  //該当IDのユーザー(ログインユーザー)のレシピを取得
        
        $follower_id = FollowUser::where('followed_user_id', Auth::id())->select('following_user_id')->get();  //フォロワー数を取得
        $follower_count = count(User::whereIn('id', $follower_id)->orderBy('created_at', 'desc')->get());
        
        $follow_id = FollowUser::where('following_user_id', Auth::id())->select('followed_user_id')->get();
        $follow_count = count(User::whereIn('id', $follow_id)->orderBy('created_at', 'desc')->get());
        
        return view('my_page')->with(['my_user' => $auth, 'recipes' => $recipes, 'follower_count' => $follower_count, 'follow_count' => $follow_count]);
    }
    
    public function edit_user()  //ユーザー情報編集画面表示
    {
        return view('edit-user')->with(['user' => Auth::user() ]);
    }
    
    public function update_user(Request $request) 
    {
        $user_form = $request->all();
        $user = Auth::user();
        
        unset($user_form['_token']);  //不要な「_token」の削除
        
        if ($request->file('image')) {  //画像が変更されたら
        $s3_delete = Storage::disk('s3')->delete($user->image_path);  //変更前の画像をs3から削除
        $image = $request->file('image');  //s3へ画像をアップロード
        $path = Storage::disk('s3')->putFile('profile', $image, 'public');  //putFile(PATH,$file)で指定したPATH（バケットの'/'フォルダ）にファイルを保存※第三引数に'public'を入れないと外部からのアクセスができない
        $user->image_path = $path;  //アップロードした画像のパスを取得
        }
        
        $user->fill($user_form)->save();  //保存
        return redirect('/my_page');
    }
    
    public function show_my_recipe()  //自分が投稿したレシピの表示
    {
        $user_id = Auth::id();  //ログインユーザー情報を取得
        $my_recipes = Recipe::where('user_id', $user_id)->withCount('nices')->orderBy('created_at', 'desc')->paginate(10);  //該当IDのユーザー(ログインユーザー)のレシピを取得
        $count = Recipe::where('user_id', $user_id)->count();;
        
        $nice_model = new Nice;
        return view('my_recipe')->with(['my_recipes' => $my_recipes, 'count' => $count, 'nice_model' => $nice_model, 'auth' => Auth::user()]);
    }
    
    public function show_nice_recipe()  //いいねしたレシピを表示
    {
        $user_id = Auth::id();  //ログインユーザーのIDを取得
        //ログインユーザーのIDと等しいnicesテーブルのuser_idを探し、そのuser_idを持つレコードのrecipe_idのみを取得
        $nice = Nice::where('user_id', $user_id)->select('recipe_id')->get();  //$niceには複数のレコードのrecipe_idが入っているため、データは配列
        //そのnicesテーブルのrecipe_idでrecipesテーブルに検索をかける
        $nice_recipes = Recipe::whereIn('id', $nice)->withCount('nices')->orderBy('created_at', 'desc')->paginate(10);  //$niceのデータが配列のためwhereInを使う
        $count = Recipe::whereIn('id', $nice)->count();
        
        $nice_model = new Nice;
        return view('my_nice_recipe')->with(['nice_recipes' => $nice_recipes, 'count' => $count, 'nice_model' => $nice_model, 'auth' => Auth::user()]);
    }
    
    public function show_my_follower()  //フォロワーを表示
    {
        $follower_id = FollowUser::where('followed_user_id', Auth::id())->select('following_user_id')->get();
        $follower = User::whereIn('id', $follower_id)->orderBy('created_at', 'desc')->paginate(20);
        
        $follower_count = User::whereIn('id', $follower_id)->count();
        
        return view('my_follower')->with(['followers' => $follower, 'follower_count' => $follower_count, 'auth' => Auth::user()]);
    }
    
    public function show_my_follow()  //フォローを表示
    {
        $follow_id = FollowUser::where('following_user_id', Auth::id())->select('followed_user_id')->get();
        $follow = User::whereIn('id', $follow_id)->orderBy('created_at', 'desc')->paginate(20);
        
        $follow_count = User::whereIn('id', $follow_id)->count();
        
        return view('my_follow')->with(['follows' => $follow, 'follow_count' => $follow_count, 'auth' => Auth::user()]);
    }
}
