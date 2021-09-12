<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
    //いいね表示用のメソッド
    public function nice(Recipe $recipe, Request $request){
        $nice=New Nice();
        $nice->recipe_id=$recipe->id;
        $nice->user_id=Auth::user()->id;
        $nice->save();
        return back();
    }
    
    //いいね取り消し用のメソッド
    public function unnice(Recipe $recipe, Request $request){
        $user=Auth::user()->id;
        $nice=Nice::where('recipe_id', $recipe->id)->where('user_id', $user)->first();  //whereで条件を絞り込み、当てはまるレコードの最初の結果を取得
        $nice->delete();
        return back();
    }
}
