<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_post', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->text('intro')->nullable();
            $table->longText('desc')->nullable();
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('content_category')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('view');
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
        Schema::dropIfExists('content_post');
    }
}
