<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('category');
            $table->string('title')->unique();
            $table->longText('body');
            $table->string('image');
            $table->string('user');
            $table->string('update');
            $table->string('approved')->default('0');
            $table->string('featured')->default('0');
            $table->string('featured_date')->default('0');
            $table->integer('views')->default('0');
            $table->string('trend_date')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
