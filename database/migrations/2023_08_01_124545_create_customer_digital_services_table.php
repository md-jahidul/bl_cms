<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDigitalServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_digital_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('subscribed_services')->nullable();
            $table->unsignedBigInteger('guest_customer_id');
            $table->timestamps();
            $table->foreign('guest_customer_id')->references('id')->on('guest_customer');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_digital_services');
    }
}
