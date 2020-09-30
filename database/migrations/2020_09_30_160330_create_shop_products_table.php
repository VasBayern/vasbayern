<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('images');
            $table->text('intro')->nullable();
            $table->text('desc')->nullable();
            $table->decimal('priceCore',12,0);
            $table->decimal('priceSale', 12, 0)->default(0)->nullable();
            $table->bigInteger('cat_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->integer('homepage')->default(0);
            $table->integer('new');
            $table->foreign('cat_id')->references('id')->on('shop_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('shop_brands')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('shop_products');
    }
}
