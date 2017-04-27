<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_translations', function (Blueprint $table) {
            $table->integer('content_id')->unsigned();
            $table->string('language_id',5);
            $table->string('title',255);
            $table->text('content');
            $table->json('images');
            
            $table->primary(['language_id','content_id']);
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('content_id')->references('id')->on('contents');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_translations');
    }
}
