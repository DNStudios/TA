<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postArticle', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')
                                      ->on('posts')
                                      ->onDelete('restrict');
            $table->integer('like_id')->unsigned();
            $table->foreign('like_id')->references('id')
                                      ->on('likes')
                                      ->onDelete('restrict');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')
                                     ->on('categories')
                                     ->onDelete('restrict');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')
                                     ->on('tags')
                                     ->onDelete('restrict');
            $table->integer('comment_id')->unsigned();
            $table->foreign('comment_id')->references('id')
                                     ->on('comments')
                                     ->onDelete('restrict');
            $table->timestamps();
            // $table->primary(array('post_id','like_id','category_id','tag_id','comment_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postArticle');
    }
}
