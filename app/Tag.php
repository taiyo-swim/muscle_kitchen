<?php
//tagsテーブル操作用モデルクラス

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    public function recipes()  //テーブルのリレーションを設定
    {
        return $this->belongsToMany('App\Recipe','recipe_tag');
    }
}
