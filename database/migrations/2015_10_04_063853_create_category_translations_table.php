<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->string('language_id',5);
            $table->string('title',255);
            $table->text('description');
            
            $table->primary(['category_id','language_id']);
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_translations');
    }
}
