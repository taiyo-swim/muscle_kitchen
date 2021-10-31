<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'image_path', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //Recipeモデル、Niceモデルとリレーションを設定
    public function recipes() {
        return $this->hasMany('App\Recipe');
    }
    
    public function recipeReviews() {
        return $this->hasMany('App\RecipeReview');
    }
    
    public function nices() {
        return $this->hasMany('App\Nice');
    }
    
    //フォロー機能のリレーションを設定
    // フォローされているユーザーを取得
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'followed_user_id', 'following_user_id');
    }

    // フォローしているユーザーを取得
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'following_user_id', 'followed_user_id');
    }
    /*第一引数には使用するモデル
　　第二引数には使用するテーブル名
　　第三引数にはリレーションを定義しているモデルの外部キー名
　　第四引数には結合するモデルの外部キー名
　　*/

}
