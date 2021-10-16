<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nice extends Model
{
    public function user()  //Userモデルとのリレーションを設定
    {
         return $this->belongsTo('App\User');
    }
    
    public function recipe()  //Recipeモデルとのリレーションを設定
    {
         return $this->belongsTo('App\Recipe');
    }
    
    //いいねが既にされているかを確認
    public function nice_exist($id, $post_id)
    {
        //nicesテーブルのレコードにユーザーidとレシピidが一致するものを取得
        
        $exist = Nice::where('user_id', '=', $id)->where('recipe_id', '=', $post_id)->get();

        // レコード（$exist）が存在するなら
        if (!$exist->isEmpty()) {
            return true;
        } else {
        // レコード（$exist）が存在しないなら
            return false;
        }
    }
}
