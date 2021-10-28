<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecipeReview extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'recipe_id',
        'user_id',
        'stars',
        'comment'
    ];
    
    public function user() 
    { 
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function recipe()
    {
         return $this->belongsTo('App\Recipe', 'recipe_id');
    }

}
