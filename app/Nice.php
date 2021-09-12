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
}
