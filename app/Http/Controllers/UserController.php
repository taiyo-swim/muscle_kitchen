<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\User;

class UserController extends Controller
{
    public function show(User $user)  //ユーザーの投稿レシピ一覧表示用メソッド
    {
        $user = User::find($user->id);  //リクエストされたユーザーのidと一致するuserテーブルのidを取得
        $recipes = Recipe::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);  //該当idのユーザーのレシピを取得
        $count = count($recipes);
        return view('user-show')->with(['user_name' => $user->name, 'recipes' => $recipes, 'count' => $count]);
    }
    
    
}
