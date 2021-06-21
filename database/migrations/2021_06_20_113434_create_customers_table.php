<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name");
            $table->string("gender");
            $table->integer("age")->nullable();
            $table->string("nationality")->nullable();
            $table->string("address")->nullable();
            $table->string("contact_no");
            $table->string("occupation")->nullable();
            $table->string("identity_no")->nullable();
            $table->string("driving_license_no")->nullable();
            $table->string("signature")->nullable();
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
        Schema::dropIfExists('customers');
    }
}
