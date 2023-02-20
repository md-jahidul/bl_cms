<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechargeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_logs', function (Blueprint $table) {
            $table->string('trx_id')->index();
            $table->string('msisdns');
            $table->string('recharge_amounts');
            $table->double('total_payment_amount', 8, 2);
            $table->string('initiate_status');
            $table->integer('initiate_status_code');
            $table->string('gateway')->nullable();
            $table->string('channel')->nullable();
            $table->string('execute_status')->nullable();
            $table->integer('execute_status_code')->nullable();
            $table->string('excitation_remarks')->nullable();
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
        Schema::dropIfExists('recharge_logs');
    }
}
