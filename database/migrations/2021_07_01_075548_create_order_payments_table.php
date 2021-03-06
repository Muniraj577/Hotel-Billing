<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("order_id")->nullable();
            $table->bigInteger("room_id")->nullable();
            $table->bigInteger("booking_id")->nullable();
            $table->bigInteger("customer_id")->nullable();
            $table->decimal("paid", 10, 2)->nullable();
            $table->decimal("due", 10, 2)->nullable();
            $table->decimal("change", 10, 2)->nullable();
            $table->date("date")->nullable();
            $table->string("pay_type")->nullable();
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
        Schema::dropIfExists('order_payments');
    }
}
