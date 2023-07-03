<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusTransactionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_transaction_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_id')->nullable();
            $table->string('ticket_no')->nullable();
            $table->string('from_station')->nullable();
            $table->string('to_station')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('bus_name')->nullable();
            $table->float('amount',8,2);
            $table->string('passenger_name')->nullable();
            $table->string('passenger_email')->nullable();
            $table->string('passenger_mobile')->nullable();
            $table->dateTime('booked_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('expiry_time')->nullable();
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
        Schema::dropIfExists('bus_transaction_status');
    }
}
