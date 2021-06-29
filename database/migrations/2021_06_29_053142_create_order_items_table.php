<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->unsignedBigInteger("unit_id")->nullable();
            $table->decimal("price", 10, 2)->nullable();
            $table->decimal("qty", 8, 2)->nullable();
            $table->decimal("discount", 10, 2)->nullable();
            $table->decimal("amount", 10, 2)->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
