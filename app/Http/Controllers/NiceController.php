<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
    
    public function ajaxnice(Request $request)
    {
        $id = Auth::user()->id;
        $recipe_id = $request->recipe_id;
        $nice = new Nice;
        $recipe = Recipe::findOrFail($recipe_id);

        // 空でない（既にいいねしている）なら
        if ($nice->nice_exist($id, $recipe_id)) {
            //likesテーブルのレコードを削除
            $nice = Nice::where('recipe_id', $recipe_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならnicesテーブルに新しいレコードを作成する
            $nice = new NIce;
            $nice->recipe_id = $request->recipe_id;
            $nice->user_id = Auth::user()->id;
            $nice->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $recipeNicesCount = $recipe->loadCount('nices')->nices_count;

        //下記の記述でajaxに引数の値を返す
        return response()->json(['recipeNicesCount' => $recipeNicesCount]);
    }
}
