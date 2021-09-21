<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function()
{
    return redirect('/home');
});


Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();
Route::get('/home', 'RecipePostController@index');  ///homeにGETリクエストが来たらRecipePostControllerのindexメソッドを実行する。(レシピ一覧画面の表示)
Route::get('/search', 'RecipePostController@search');  //レシピ検索機能の実行
Route::get('/tag_search', 'RecipePostController@tag_search');  //タグ検索の実行
Route::group(['middleware' => 'auth'], function() {  //ログイン済みのユーザーにのみ許可
Route::get('/recipes/create', 'RecipePostController@create'); ///recipes/createにGETリクエストが来たらRecipePostControllerのcreateメソッドを実行する。(レシピ投稿画面の表示)
Route::post('/recipes', 'RecipePostController@store');  ///recipesにPOSTリクエストが来たらRecipePostControllerのstoreメソッドを実行する。(レシピ投稿の実行)
Route::get('/recipes/{recipe}', 'RecipePostController@show');  ///recipes/{recipe}にGETリクエストが来たらRecipePostControllerのshowメソッドを実行する。(レシピ詳細画面の表示)
Route::get('/recipes/{recipe}/edit', 'RecipePostController@edit');  //レシピ編集画面の表示
Route::put('/recipes/{recipe}', 'RecipePostController@update');  //レシピ投稿編集の実行
Route::delete('/recipes/{recipe}', 'RecipePostController@delete');  //レシピ投稿削除の実行
Route::get('recipes/nice/{recipe}', 'NiceController@nice')->name('nice');  //いいねの実行
Route::get('recipes/unnice/{recipe}', 'NiceController@unnice')->name('unnice');  //いいねの取り消し
Route::get('/users/{user}', 'UserController@show');  //ユーザーの投稿一覧の表示
Route::get('/my_page', 'My_pageController@index');  //マイページの表示
Route::get('/my_page/my_recipes', 'My_pageController@show_my_recipe');  //マイレシピの表示
Route::get('/my_page/my_nice_recipes', 'My_pageController@show_nice_recipe');  //いいねしたレシピの表示
});

Route::get('/auth/google', 'OAuthLoginController@getGoogleAuth');
Route::get('/auth/callback/google', 'OAuthLoginController@authGoogleCallback');

Route::get('/test', 'RecipePostController@test');