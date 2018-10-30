<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('art_id');
            $table->string('art_title');
            $table->string('art_tag');
            $table->string('art_description');
            $table->string('art_thumb');
            $table->text('art_content');
            $table->string('art_time');
            $table->string('art_editor');
            // $table->integer('art_view')->default('0');
            // $table->integer('cate_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
    }
}
