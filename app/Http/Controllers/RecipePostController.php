<?php
//レシピ投稿を扱うコントローラークラス

namespace App\Http\Controllers;

use App\Recipe;  //Recipeモデルクラスをuse宣言
use App\Tag;  //Tagモデルクラスをuse宣言
use App\Http\Requests\RecipePostRequest;

class RecipePostController extends Controller
{
    /**
    * レシピ一覧を表示する
    * 
    * @param Recipe Recipeモデル
    * @return view('表示されるviewの名前')->with(['変数名' => 値]);
    * get()メソッドでDBから持ってきたデータ($recipe)をrecipesという変数名でviewに渡す
    */
    public function index(Recipe $recipe)
    {
        return view('home')->with(['recipes' => $recipe->getPaginateByLimit()]);
    }
    
    //特定IDのrecipeを表示する
    public function show(Recipe $recipe)  // 引数の$postはid=1のPostインスタンス
    {
        return view('show-recipe')->with(['recipe' => $recipe]);
    }
    
    //レシピ投稿画面を表示
    public function create()
    {
        return view('recipe-create');
    }
    
    //レシピ投稿の実行
    public function store(RecipePostRequest $request, Recipe $recipe)
    {
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ一-龠]+)/u', $request->tags, $match);
        
        
        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使う。
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]);  // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record);  // $recordを配列に追加する(=$tags)
        }
        
        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        }
        
        

        // 投稿はrecipesテーブルへレコードする。
        $input = $request['recipe_post'];
        $recipe->title = $input['title'];
        $recipe->explanation = $input['explanation'];
        $recipe->ingredients = $input['ingredients'];
        $recipe->how_to_cook = $input['how_to_cook'];
        $recipe->point = $input['point'];
        //$filename = $request->file('image')->store('public');  //publicフォルダに画像を保存
        //$recipe->image = str_replace('public/','',$filename);  //保存するファイル名からpublicを除外
        $recipe->save();
        
        $recipe->tags()->attach($tags_id);  //attachメソッドをつかい、紐づけ対象のidを引数にしてリレーションを紐づけ、モデルを結びつけている中間テーブルにレコードを挿入する。
                                            //タグは$recipeがsaveされた後にattach
        
        return redirect('/recipes/' . $recipe->id);  //レシピ詳細画面へリダイレクト
    }
    
    public function edit(Recipe $recipe)  //レシピ編集画面の表示
    {
        return view('edit-recipe')->with(['recipe' => $recipe]);
    }
    
    //レシピ投稿編集の実行
    public function update(RecipePostRequest $request, Recipe $recipe)
    {
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ一-龠]+)/u', $request->tags, $match);
        
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]);
            array_push($tags, $record);
        }
        
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        }
        
        $input_post = $request['recipe_post'];
        $recipe->title = $input_post['title'];
        $recipe->explanation = $input_post['explanation'];
        $recipe->ingredients = $input_post['ingredients'];
        $recipe->how_to_cook = $input_post['how_to_cook'];
        $recipe->point = $input_post['point'];
        //$filename = $request->file('image')->store('public');  //publicフォルダに画像を保存
        //$recipe->image = str_replace('public/','',$filename);  //保存するファイル名からpublicを除外
        $recipe->save();
        
        $recipe->tags()->sync($tags_id);  //attachをsyncにすることでリレーション先のデータを更新できる
        
        return redirect('/recipes/' . $recipe->id);  //レシピ詳細画面へリダイレクト
    }
}

