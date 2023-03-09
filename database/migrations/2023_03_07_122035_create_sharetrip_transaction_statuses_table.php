<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharetripTransactionStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sharetrip_transaction_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('createdAt')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('pnr_code')->nullable();
            $table->string('booking_code')->nullable();
            $table->string('booking_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->double('amount', 8, 2)->nullable();
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
        Schema::dropIfExists('sharetrip_transaction_statuses');
    }
}
