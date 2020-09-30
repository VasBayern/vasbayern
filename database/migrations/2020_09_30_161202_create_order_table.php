<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->text('note')->nullable();
            $table->string('shipment');
            $table->string('status');
            $table->decimal('sub_total', 12, 0);
            $table->decimal('ship_price', 12, 0);
            $table->decimal('promotion', 12, 0);
            $table->decimal('total', 12, 0);
            $table->string('payment_method');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('order');
    }
}
