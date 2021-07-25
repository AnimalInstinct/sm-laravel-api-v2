<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_id')->nullable();
            $table->boolean('published')->default('1')->nullable();
            $table->string('caption')->nullable();
            $table->string('alt')->nullable();
            $table->longText('description')->nullable();
            $table->string('path')->nullable();
            $table->string('name')->nullable();
            $table->string('geo')->nullable();
            $table->string('thumbnail_sm')->nullable();
            $table->string('thumbnail_md')->nullable();
            $table->string('thumbnail_lg')->nullable();
            $table->string('imageable_type')->nullable();
            $table->string('imageable_id')->nullable();
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
        Schema::dropIfExists('images');
    }
}
