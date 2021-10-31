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
// Route::get('/', function()
// {
//     return redirect('/home');
// });


Route::get('/home', 'HomeController@index')->name('home');

/*
{recipe} = レシピのid
{user} = ユーザーのid
{recipeReview} = レビューのid
*/


Auth::routes(['valify' => true]);
Route::get('/', 'RecipePostController@index');  ///homeにGETリクエストが来たらRecipePostControllerのindexメソッドを実行する。(レシピ一覧画面の表示)
Route::get('/search', 'RecipePostController@search');  //レシピ検索機能の実行
Route::get('/tag_search', 'RecipePostController@tag_search');  //タグ検索の実行
Route::get('/search_by_nicecount', 'RecipePostController@order_nice_count');  //いいねの多い順に表示
Route::group(['middleware' => 'auth'], function() {  //ログイン済みのユーザーにのみ許可
Route::get('/recipes/create', 'RecipePostController@create'); ///recipes/createにGETリクエストが来たらRecipePostControllerのcreateメソッドを実行する。(レシピ投稿画面の表示)
Route::post('/recipes', 'RecipePostController@store');  ///recipesにPOSTリクエストが来たらRecipePostControllerのstoreメソッドを実行する。(レシピ投稿の実行)
Route::get('/recipes/{recipe}', 'RecipePostController@show');  ///recipes/{recipe}にGETリクエストが来たらRecipePostControllerのshowメソッドを実行する。(レシピ詳細画面の表示)
Route::get('/recipes/{recipe}/edit', 'RecipePostController@edit');  //レシピ編集画面の表示
Route::put('/recipes/{recipe}', 'RecipePostController@update');  //レシピ投稿編集の実行
Route::delete('/recipes/{recipe}', 'RecipePostController@delete');  //レシピ投稿削除の実行
Route::get('recipes/{recipe}/review', 'RecipePostController@review'); //レビュー画面の表示
Route::post('recipes/{recipe}/create_review', 'RecipePostController@create_review');  //レビューの送信
Route::delete('recipes/{recipe}/review', 'RecipePostController@delete_review');  //レビューの削除
Route::post('recipes/{recipe}/nice', 'NiceController@ajaxnice');
Route::get('/users/{user}', 'UserController@index');  //ユーザーページの表示
Route::get('/users/{user}/recipes', 'UserController@show_user_recipe');  //ユーザーのレシピの表示
Route::get('/users/{user}/nice_recipes', 'UserController@show_user_nice_recipe');  //ユーザーがいいねしたレシピの表示
Route::post('/users/{user}/follow', 'UserController@follow');  //フォローの実行
Route::post('/users/{user}/unfollow', 'UserController@unfollow');  //フォローの取り消し
Route::get('/users/{user}/follower', 'UserController@show_follower');  //ユーザーのフォロワー一覧を表示
Route::get('/users/{user}/follow', 'UserController@show_follow');  //ユーザーのフォロー一覧を表示
Route::get('/my_page', 'My_pageController@index');  //マイページの表示
Route::get('/my_page/edit_user', 'My_pageController@edit_user');  //ユーザー情報編集画面表示
Route::put('my_page/', 'My_pageController@update_user');  //ユーザー情報編集実行
Route::get('/my_page/my_recipes', 'My_pageController@show_my_recipe');  //マイレシピの表示
Route::get('/my_page/my_nice_recipes', 'My_pageController@show_nice_recipe');  //いいねしたレシピの表示
Route::get('my_page/follower', 'My_pageController@show_my_follower');  //フォロワー一覧の表示
Route::get('my_page/follow', 'My_pageController@show_my_follow');  //フォロー一覧の表示
});

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/test', 'RecipePostController@test');