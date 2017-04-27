<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->nullable();
            $table->text('description')->nullable();
            $table->text('image');
            $table->text('thumb_image');
            $table->string('type',50);
            $table->integer('ordering');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->string('status',1)->default('1');
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sliders');
    }
}
