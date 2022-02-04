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
    'serving',
    'ingredients',
    'amount_of_ingredients',
    'cooktimes',
    'how_to_cook',
    'point'
    ];
    
    public function tags()  //Tgaモデルとのリレーションを設定
    {
        return $this->belongsToMany('App\Tag','recipe_tag');
    }
    
    public function user()  //Userモデルとのリレーションを設定
    {
         return $this->belongsTo('App\User');
    }
    
    public function nices()  //Niceモデルとのリレーションを設定
    {
         return $this->hasMany('App\Nice');
    }
    
     public function recipeReviews()  //Reviewモデルとのリレーションを設定
    { 

        return $this->hasMany('App\RecipeReview');

    }
    
    public function getPaginateByLimit(int $limit_count = 12)  //データの取得制限
    {
        //created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function makeTag(){
        $output = '';
        foreach($this->tags()->get() as $tag){  //getで得たrecipesテーブルと関連したtagsテーブルのデータをforeachし、1つずつ#とnameカラムの値を付け加えて$outputに代入
            $output = $output.'#'.$tag->name;
        }
        return $output;
    }
}
