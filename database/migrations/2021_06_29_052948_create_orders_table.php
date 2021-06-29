<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("booking_id")->nullable();
            $table->unsignedBigInteger("room_id")->nullable();
            $table->unsignedBigInteger("customer_id")->nullable();
            $table->decimal("total", 10, 2)->nullable();
            $table->decimal("paid", 10, 2)->nullable();
            $table->decimal("due", 10, 2)->nullable();
            $table->decimal("change_amount", 10, 2)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
