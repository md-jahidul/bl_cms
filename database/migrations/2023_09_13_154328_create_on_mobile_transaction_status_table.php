<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnMobileTransactionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_mobile_transaction_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('createdAt')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->string('subscriptionId')->nullable();
            $table->string('event')->nullable();
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
        Schema::dropIfExists('on_mobile_transaction_status');
    }
}
