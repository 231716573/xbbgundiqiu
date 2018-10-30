<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary', function (Blueprint $table) {
            $table->increments('id');
            $table->string('diary_title');
            $table->string('diary_tag');
            $table->string('diary_description');
            $table->string('diary_thumb');
            $table->text('diary_content');
            $table->string('diary_time');
            $table->string('diary_editor');
            $table->integer('diary_view')->default('0');
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
        Schema::drop('diary');
    }
}
