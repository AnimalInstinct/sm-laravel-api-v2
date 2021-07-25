<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parent_id')->nullable();
            $table->boolean('published')->default('0')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('alias')->nullable();
            $table->string('seotitle')->nullable();
            $table->string('seokeywords')->nullable();
            $table->text('seodescription')->nullable();
            $table->text('intro_text')->nullable();
            $table->string('display_image_id')->nullable();
            $table->string('author')->nullable();
            $table->string('language_id')->nullable();
            $table->string('site_id')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
