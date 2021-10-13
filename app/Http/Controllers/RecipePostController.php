<?php
//レシピ投稿を扱うコントローラークラス

namespace App\Http\Controllers;

use App\Recipe;  //Recipeモデルクラスをuse宣言
use App\Tag;  //Tagモデルクラスをuse宣言
use App\Http\Requests\RecipePostRequest;
use Illuminate\Http\Request;
use App\Nice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RecipePostController extends Controller
{
    //ホーム画面にレシピ投稿一覧を表示(検索機能の追加)
    public function index(Recipe $recipe)
    {
        return view('home')->with('recipes', $recipe->getPaginateByLimit());
    }
    
    //検索機能の実行
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');  //検索フォームで入力されたキーワードを受け取る
        
        $query = Recipe::query();  //クエリを生成
        if(!empty($keyword))  //検索フォームにキーワードが入力されたときの処理
        {
            //whereで検索条件の絞り込み($keywordであいまい検索)、orWhereHasでリレーション先のテーブルのレコードから検索
            $query->where('title','like','%'.$keyword.'%')->orWhere('ingredients','like','%'.$keyword.'%')->orWhereHas('tags', function($query) use ($keyword){
                $query->where('name','like','%'.$keyword.'%');
            });
        }
        $recipe = $query->orderBy('created_at','desc')->paginate(10);
        $count = count($recipe);
        return view('search-recipe')->with(['recipes' => $recipe, 'keyword' => $keyword, 'count' => $count, 'auth' => Auth::user()]);
    }
    
    //タグ検索機能の実行（タグが押されたときにそのタグが付いているレシピのみを表示）
    public function tag_search(Request $request)
    {
        $keyword = $request->input('tag_keyword');
        $query =Recipe::query();
        
        $query->whereHas('tags', function($query) use ($keyword){$query->where('name','like','%'.$keyword.'%');});
        
        $recipe =$query->orderBy('created_at','desc')->paginate(10);
        $count = count($recipe);
        return view('search-recipe')->with(['recipes' => $recipe, 'keyword' =>$keyword, 'count' => $count, 'auth' => Auth::user()]);
    }
    
    //特定IDのrecipeを表示する
    public function show(Recipe $recipe)  // 引数の$postはid=1のPostインスタンス
    {
        $nice=Nice::where('recipe_id', $recipe->id)->where('user_id', auth()->user()->id)->first();  //いいね表示用のコードを追加
        return view('show-recipe')->with(['recipe' => $recipe, 'nice' => $nice, 'auth' => Auth::user()]);
    }
    
    //レシピ投稿画面を表示
    public function create()
    {
        $tags = Tag::all();
        return view('create-recipe')->with(['tags' => $tags]);
    }
    
    //レシピ投稿の実行
    public function store(RecipePostRequest $request, Recipe $recipe)
    {
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んーァ-ンヴー一-龠]+)/u', $request->tags, $match);
        
        
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
        $recipe->serving = $input['serving'];
        $recipe->ingredients = implode("\n", $input['ingredients']);
        $recipe->amount_of_ingredients = implode("\n", $input['amount_of_ingredients']);
        $recipe->how_to_cook = implode("\n・", $input['how_to_cook']);
        $recipe->point = $input['point'];
        $recipe->user_id = auth()->id();
        
        if ($request->file('image')) {
        $image = $request->file('image');  //s3へ画像をアップロード
        $path = Storage::disk('s3')->putFile('recipes', $image, 'public');  //putFile(PATH,$file)で指定したPATH（バケットの'/'フォルダ）にファイルを保存※第三引数に'public'を入れないと外部からのアクセスができない
        $recipe->image_path = $path;  //アップロードした画像のパスを取得
        }
        
        $recipe->save();
        
        $recipe->tags()->attach($tags_id);  //attachメソッドをつかい、紐づけ対象のidを引数にしてリレーションを紐づけ、モデルを結びつけている中間テーブルにレコードを挿入する。
                                            //タグは$recipeがsaveされた後にattach
        
        return redirect('/recipes/' . $recipe->id);  //レシピ詳細画面へリダイレクト
    }
    
    public function edit(Recipe $recipe)  //レシピ編集画面の表示
    {
        
        $recipe_ingredients = explode("\n", $recipe->ingredients);
        $ingredients_count = count($recipe_ingredients);
        
        $recipe_amount_of_ingredients = explode("\n", $recipe->amount_of_ingredients);
        $amount_of_ingredients_count = count($recipe_amount_of_ingredients);
        
        $recipe_how_to_cook = explode("\n・", $recipe->how_to_cook);
        $how_to_cook_count = count($recipe_how_to_cook);
        
        $this->authorize('update', $recipe);  //ポリシーを元に投稿したユーザー以外は編集画面が表示されないようにアクションを認可
        return view('edit-recipe')->with(['recipe' => $recipe, 'recipe_ingredients' => $recipe_ingredients, 'recipe_amount_of_ingredients' => $recipe_amount_of_ingredients, 'recipe_how_to_cook' => $recipe_how_to_cook,
        'ingredients_count' => $ingredients_count, 'amount_of_ingredients_count' => $amount_of_ingredients_count, 'how_to_cook_count' => $how_to_cook_count]);
    }
    
    //レシピ投稿編集の実行
    public function update(RecipePostRequest $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);  //ポリシーを元に投稿したユーザー以外は編集できないようにアクションを認可
        
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んーァ-ンヴー一-龠]+)/u', $request->tags, $match);
        
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
        $recipe->serving = $input_post['serving'];
        $recipe->ingredients = implode("\n", $input_post['ingredients']);
        $recipe->amount_of_ingredients = implode("\n", $input_post['amount_of_ingredients']);
        $recipe->how_to_cook = implode("\n・", $input_post['how_to_cook']);
        $recipe->point = $input_post['point'];
        
        if ($request->file('image')) {  //画像が変更されたら
        $s3_delete = Storage::disk('s3')->delete($recipe->image_path);  //変更前の画像をs3から削除
        $image = $request->file('image');  //s3へ画像をアップロード
        $path = Storage::disk('s3')->putFile('recipes', $image, 'public');  //putFile(PATH,$file)で指定したPATH（バケットの'/'フォルダ）にファイルを保存※第三引数に'public'を入れないと外部からのアクセスができない
        $recipe->image_path = $path;  //アップロードした画像のパスを取得
        }
        
        $recipe->save();
        
        $recipe->tags()->sync($tags_id);  //attachをsyncにすることでリレーション先のデータを更新できる
        
        return redirect('/recipes/' . $recipe->id);  //レシピ詳細画面へリダイレクト
    }
    
    //レシピ投稿を削除する
    public function delete(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);  //ポリシーを元に投稿したユーザー以外は削除できないようにアクションを認可
        $s3_delete = Storage::disk('s3')->delete($recipe->image_path);  //s3の画像を削除
        $recipe->delete();
        return redirect('/home');
    }
}

