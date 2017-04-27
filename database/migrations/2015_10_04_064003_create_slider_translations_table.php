<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_translations', function (Blueprint $table) {
            $table->integer('slider_id')->unsigned();
            $table->string('language_id',5);
            $table->string('title',100)->nullable();
            $table->text('description')->nullable();
            $table->text('image');
            
            $table->primary('slider_id', 'language_id');
            $table->foreign('slider_id')->references('id')->on('sliders');
            $table->foreign('language_id')->references('id')->on('languages');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slider_translations');
    }
}
