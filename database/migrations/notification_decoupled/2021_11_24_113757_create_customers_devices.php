<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn');
            $table->text('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('customer_type')->nullable();
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
        Schema::dropIfExists('customers_devices');
    }
}
