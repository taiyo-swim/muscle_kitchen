<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;


class OAuthLoginController extends Controller
{
    public function getGoogleAuth()  //Googleの認証画面にリダイレクト
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function authGoogleCallback()  //Google認証後の処理(コールバック)
    {
        $googleUser = Socialite::driver('google')->user();  //OAuth認証画面にリダイレクトして認証を行った後、$googleUserにGoogleアカウントのユーザー情報が格納される
        //$googleUser->emailがDBに登録されていなければ、DBに$googleUserをユーザ情報として登録する
        $user = User::firstOrNew(['email' => $googleUser->email]);
        if (!$user->exists) {
            $user['name'] = $googleUser->getNickname() ?? $googleUser->getName() ?? $googleUser->getNick();
            $user['email'] = $googleUser->email;
            $user['verified'] = 1;
            $user['google_id'] = $googleUser->getId();
            $user['google_name'] = $googleUser->getNickname() ?? $googleUser->getName() ?? $googleUser->getNick();
            $user->save();
        }
        Auth::login($user);  //$user(Googleユーザー)でログイン
        return redirect('/home');  ///homeへリダイレクト
    }
}
