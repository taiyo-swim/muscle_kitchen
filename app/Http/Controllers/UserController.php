<?php  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\User;
use App\Nice;
use App\FollowUser;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)  //ユーザーページ表示用メソッド
    {
        $defaultCount = count($user->followUsers);  //フォロワー数を取得
        //ログインユーザーのIDでfollow_usersテーブルのfollowing_user_idに検索をかけ一致する数を取得(既にフォローしていれば1になる)
        $defaultFollowed = $user->followUsers()->where('following_user_id', Auth::user()->id)->count();
        //既にフォローしている場合はfalse、していない場合はtrueに条件分岐
        if($defaultFollowed == 0){
            $defaultFollowed = false;
        } else {
            $defaultFollowed = true;
        }
        
        if($user != Auth::user()){  //ユーザーが自分ではない場合
        $user = User::find($user->id);  //リクエストされたユーザーのidと一致するuserテーブルのidを取得
        $recipes = Recipe::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        //ユーザーのフォロー数を取得
        $follow_id = FollowUser::where('following_user_id', $user->id)->select('followed_user_id')->get();
        $follow_count = count($user->whereIn('id', $follow_id)->orderBy('created_at', 'desc')->paginate(10));
        
        return view('user_page')->with(['user' => $user, 'recipes' => $recipes, 'defaultFollowed' => $defaultFollowed, 'defaultCount' => $defaultCount, 'follow_count' =>$follow_count]);
        }
    }
    
    public function show_user_recipe(User $user)  //ユーザーの投稿レシピ一覧表示用メソッド
    {
        if($user != Auth::user()){  //ユーザーが自分ではない場合
        $user = User::find($user->id);  //リクエストされたユーザーのidと一致するuserテーブルのidを取得
        $recipes = Recipe::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);  //該当idのユーザーのレシピを取得
        $count = count($recipes);
        return view('user_recipe')->with(['user' => $user, 'recipes' => $recipes, 'count' => $count]);
        }
    }
    
    public function show_user_nice_recipe(User $user)  //ユーザーがいいねしたレシピを表示
    {
        if($user != Auth::user()){  //ユーザーが自分ではない場合
        //ユーザーのIDと等しいnicesテーブルのuser_idを探し、そのuser_idを持つレコードのrecipe_idのみを取得
        $nice = Nice::where('user_id', $user->id)->select('recipe_id')->get();  //$niceには複数のレコードのrecipe_idが入っているため、データは配列
        //そのnicesテーブルのrecipe_idでrecipesテーブルに検索をかける
        $nice_recipes = Recipe::whereIn('id', $nice)->orderBy('created_at', 'desc')->paginate(10);  //$niceのデータが配列のためwhereInを使う
        $count = count($nice_recipes);
        return view('user_nice_recipe')->with(['user' => $user, 'nice_recipes' => $nice_recipes, 'count' => $count]);
        }
    }
    
    public function follow(User $user)  //フォローの実行
    {
        $follow = FollowUser::create([
            'following_user_id' => Auth::user()->id,  //フォローするのは認証ユーザーのためAuthからIDを取得
            'followed_user_id' => $user->id,  //フォローされるユーザーのIDを取得
        ]);
        
        $followCount = count(FollowUser::where('followed_user_id', $user->id)->get());  //フォローされているユーザーの数を取得
        return response()->json(['followCount' => $followCount]);  //json形式でレスポンスを返す
    }

    public function unfollow(User $user)  //フォローの取り消し
    {
        //follow_usersテーブルからフォローするユーザーのIDとフォローされるユーザーのIDで絞り込みをかけ、最初の1つを取り出す
        $follow = FollowUser::where('following_user_id', Auth::user()->id)->where('followed_user_id', $user->id)->first();
        $follow->delete();
        $followCount = count(FollowUser::where('followed_user_id', $user->id)->get());

        return response()->json(['followCount' => $followCount]);
    }
    
    public function show_follower(User $user)  //ユーザーのフォロワーを表示
    {
        //follow_usersテーブルのfollowed_user_idにユーザーのIDで検索をかけ、following_user_idだけを取得
        $follower_id = FollowUser::where('followed_user_id', $user->id)->select('following_user_id')->get();
        //usersテーブルのidにフォロワーのIDで検索をかけてフォロワーのユーザー情報を取得
        $follower = $user->whereIn('id', $follower_id)->orderBy('created_at', 'desc')->paginate(10);
        
        $follower_count = count($follower);
        
        return view('follower')->with(['followers' => $follower, 'follower_count' => $follower_count, 'user' => $user, 'auth' => Auth::user()->id]);
    }
    
    public function show_follow(User $user)  //ユーザーのフォローを表示
    {
        $follow_id = FollowUser::where('following_user_id', $user->id)->select('followed_user_id')->get();
        $follow = $user->whereIn('id', $follow_id)->orderBy('created_at', 'desc')->paginate(10);
        
        $follow_count = count($follow);
        
        return view('follow')->with(['follows' => $follow, 'follow_count' => $follow_count, 'user' => $user, 'auth' => Auth::user()->id]);
    }
    
}
