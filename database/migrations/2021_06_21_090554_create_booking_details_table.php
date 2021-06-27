<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->onDelete("set null")->nullable()->constrained("customers");
            $table->date("arrival_date");
            $table->date("nepali_arrival_date")->nullable();
            $table->string("arrival_time")->nullable();
            $table->date("departure_date")->nullable();
            $table->date("nepali_departure_date")->nullable();
            $table->string("departure_time")->nullable();
            $table->decimal("total", 10,2)->nullable();
            $table->decimal("paid", 10,2)->nullable();
            $table->decimal("change_amount", 10, 2)->nullable();
            $table->decimal("due", 10, 2)->nullable();
            $table->integer("no_of_rooms")->nullable();
            $table->integer("no_of_relative")->nullable();
            $table->tinyInteger("status")->nullable()->default(1);
            $table->longText("purpose")->nullable();
            $table->longText("remarks")->nullable();
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
        Schema::dropIfExists('booking_details');
    }
}
