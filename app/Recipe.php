<?php
//recipesテーブル操作用モデルクラス

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Recipe extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    'title',
    'explanation',
    'image',
    'ingredients',
    'how_to_cook',
    'point'
    ];
    
    public function tags()  //tagsテーブルとのリレーションを設定
    {
        return $this->belongsToMany('App\Tag','recipe_tag');
    }
    
    public function user()  //usersテーブルとのリレーションを設定
    {
         return $this->belongsTo('App\User');
    }
    
    public function getPaginateByLimit(int $limit_count = 10)  //データの取得制限
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function makeTag(){
        $output = '';
        foreach($this->tags()->get() as $tag){  //getで得たrecipesテーブルと関連したtagsテーブルのデータをforeachし、1つずつ#とnameカラムの値を付け加えて$outputに代入
            $output = $output.'#'.$tag->name;
        }
        return $output;
    }
}
