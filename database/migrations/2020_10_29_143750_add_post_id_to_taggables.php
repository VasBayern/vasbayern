<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostIdToTaggables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taggables', function (Blueprint $table) {
            $table->dropForeign('taggables_product_id_foreign');
            $table->dropForeign('taggables_tag_id_foreign');
        });
        Schema::dropIfExists('taggables');
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->length(20)->nullable();
            $table->unsignedBigInteger('post_id')->length(20)->nullable();
            $table->unsignedBigInteger('tag_id')->length(20)->nullable();
            $table->foreign('product_id')->references('id')->on('shop_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('content_post')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('taggables', function (Blueprint $table) {
            //
        });
    }
}
