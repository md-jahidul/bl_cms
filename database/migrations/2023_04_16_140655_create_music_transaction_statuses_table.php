<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicTransactionStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_transaction_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subscription_request_id')->nullable();
            $table->string('action_type')->nullable();
            $table->string('action_message')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('service_id')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('music_transaction_statuses');
    }
}
