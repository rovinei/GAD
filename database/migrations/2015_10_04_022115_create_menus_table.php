<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);    
            $table->text('content');
            $table->string('position',1)->default('1');
            $table->string('icon',50);
            $table->integer('ordering');
            $table->string('type',1)->default('1');
            $table->string('internal_url')->nullable();
            $table->string('external_url')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('level');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->string('status',1)->default('1');
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('menus');
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
        Schema::drop('menus');
    }
}
