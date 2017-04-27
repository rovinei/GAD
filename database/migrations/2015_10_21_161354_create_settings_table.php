<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',255);
            $table->string('copyright',255);
            $table->text('company_logo');
            $table->text('meta_keyword');
            $table->text('meta_description');
            $table->text('meta_title');
            $table->text('meta_content');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->string('status',1)->default('1');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
