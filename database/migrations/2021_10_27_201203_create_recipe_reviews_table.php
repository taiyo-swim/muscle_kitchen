<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recipe_id')->default(0)->comment('レシピID');
            $table->unsignedInteger('user_id')->default(0)->comment('ユーザーID');
            $table->integer('stars')->default(0)->comment('星');
            $table->text('comment')->comment('コメント');
            $table->timestamps();
            
            
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_reviews');
    }
}
