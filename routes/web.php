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

Route::get('/home', 'RecipePostController@index');  ///homeにGETリクエストが来たらRecipePostControllerのindexメソッドを実行する。
Route::get('/recipes/create', 'RecipePostController@create'); ///recipes/createにGETリクエストが来たらRecipePostControllerのcreateメソッドを実行する。
Route::post('/recipes', 'RecipePostController@store');  ///recipesにPOSTリクエストが来たらRecipePostControllerのstoreメソッドを実行する。
Route::get('/recipes/{recipe}', 'RecipePostController@show');  ///recipes/{recipe}にGETリクエストが来たらRecipePostControllerのshowメソッドを実行する。