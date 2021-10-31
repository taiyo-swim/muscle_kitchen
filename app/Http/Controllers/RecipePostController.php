<?php
//レシピ投稿を扱うコントローラークラス

namespace App\Http\Controllers;

use App\Recipe;  //Recipeモデルクラスをuse宣言
use App\User;
use App\Tag;  //Tagモデルクラスをuse宣言
use App\Http\Requests\RecipePostRequest;
use Illuminate\Http\Request;
use App\Nice;
use App\RecipeReview;
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
            $query->where('title','like','%'.$keyword.'%')->orWhere('ingredients','like','%'.$keyword.'%')->orWhere('explanation','like','%'.$keyword.'%')->orWhereHas('tags', function($query) use ($keyword){
                $query->where('name','like','%'.$keyword.'%');
            });
        }
        $recipes = $query->withCount('nices')->orderBy('created_at','desc')->paginate(10);
        $count = $query->count();
        
        $nice_model = new Nice;
        return view('search-recipe')->with(['recipes' => $recipes, 'keyword' => $keyword, 'count' => $count, 'nice_model' => $nice_model, 'auth' => Auth::user()]);
    }
    
    //タグ検索機能の実行（タグが押されたときにそのタグが付いているレシピのみを表示）
    public function tag_search(Request $request)
    {
        $keyword = $request->input('tag_keyword');
        $query =Recipe::query();
        
        $query->whereHas('tags', function($query) use ($keyword){$query->where('name','like','%'.$keyword.'%');});
        
        $recipes = $query->withCount('nices')->orderBy('created_at','desc')->paginate(10);
        $count = $query->count();
        
        $nice_model = new Nice;
        return view('search-recipe')->with(['recipes' => $recipes, 'keyword' =>$keyword, 'count' => $count, 'nice_model' => $nice_model, 'auth' => Auth::user()]);
    }
    
    //特定IDのrecipeを表示する
    public function show(Recipe $recipe)  // 引数の$postはid=1のPostインスタンス
    {
        // $nice=Nice::where('recipe_id', $recipe->id)->where('user_id', auth()->user()->id)->first();  //いいね表示用のコードを追加
        $nice_count = $recipe->loadCount('nices');
        $nice_model = new Nice;
        
        $recipeReviews = RecipeReview::where('recipe_id', $recipe->id)->get(); 
        $review_count = count($recipeReviews); 
        $recipeReview = $recipeReviews->first();
        
        return view('show-recipe')->with(['recipe' => $recipe, 'nice_model' => $nice_model, 'recipeReview' => $recipeReview, 'review_count' => $review_count,'auth' => Auth::user()]);
    }
    
    public function order_nice_count(Recipe $recipe)
    {
        $recipes = $recipe->withCount('nices')->orderBy('nices_count', 'desc')->paginate(10);
        $nice_count = $recipe->withCount('nices');
        $nice_model = new Nice;
        return view('order-nice-count')->with(['recipes' => $recipes, 'nice_model' => $nice_model, 'auth' => Auth::user()]);
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
        return redirect('/');
    }
  
    //レビューの投稿画面表示
    public function review(RecipeReview $recipeReview, $recipe)  //$recipeはルーティングから取ってきたレシピのid
    {
        $recipeReviews = $recipeReview->where('recipe_id', $recipe)->get();  //該当レシピのレビューだけをrecipe_idで絞り込んで取得
        $review_recipe = Recipe::where('id', $recipe)->first();  //Recipeからidで絞り込んで該当レシピを取得
        $review_count = count($recipeReviews);  //レビュー数を取得
        $exist_review = $recipeReviews->where('user_id', Auth::user()->id)->first();  //ログインユーザーのレビューを取得
        
        return view('recipe_review')->with(['recipeReviews' => $recipeReviews, 'recipe' => $review_recipe, 'review_count' => $review_count, 'exist_review' => $exist_review, 'auth_id' => Auth::user()->id]);
    }
    
    //レビューの投稿
    public function create_review(Request $request, RecipeReview $recipeReview, Recipe $recipe) 
    {
        $this->validate($request, [
            'review.stars' => 'required|integer|min:1|max:5',
            'review.comment' => 'required'
        ]);
        
        $input_review = $request['review'];
        $recipeReview->stars = $input_review['stars'];
        $recipeReview->comment = $input_review['comment'];
        $recipeReview->user_id = $request->user()->id;
        $recipeReview->recipe_id = $recipe->id;
        
        $recipeReview->save();
        return redirect('/recipes/' . $recipeReview->recipe_id . '/review');
    }
    
    //レビューの削除
    public function delete_review($recipeReview)  //$recipeReviewはルーティングから取ってきたレビューのid
    {
        $delete_recipeReview = RecipeReview::where('id', $recipeReview)->first();  //削除するレビューをidで検索して取得
        // $this->authorize('delete_review', $delete_recipeReview);
        
        $recipe_id = $delete_recipeReview->recipe->id;  //リレーションでレシピのidを取得
        $delete_recipeReview->delete();  //レビューを削除
        
        return redirect('/recipes/' . $recipe_id . '/review');
    }
}

