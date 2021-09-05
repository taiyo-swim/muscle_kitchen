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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'RecipePostController@index');  ///homeにGETリクエストが来たらRecipePostControllerのindexメソッドを実行する。(レシピ一覧画面の表示)
Route::get('/recipes/create', 'RecipePostController@create'); ///recipes/createにGETリクエストが来たらRecipePostControllerのcreateメソッドを実行する。(レシピ投稿画面の表示)
Route::post('/recipes', 'RecipePostController@store');  ///recipesにPOSTリクエストが来たらRecipePostControllerのstoreメソッドを実行する。(レシピ投稿の実行)
Route::get('/recipes/{recipe}', 'RecipePostController@show');  ///recipes/{recipe}にGETリクエストが来たらRecipePostControllerのshowメソッドを実行する。(レシピ詳細画面の表示)
Route::get('/recipes/{recipe}/edit', 'RecipePostController@edit');  //レシピ編集画面の表示
Route::put('/recipes/{recipe}', 'RecipePostController@update');  //レシピ投稿編集の実行