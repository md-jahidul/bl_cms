<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceBillStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_bill_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('result');
            $table->string('message');
            $table->string('bill_payment_id');
            $table->string('bill_refer_id');
            $table->string('bill_id');
            $table->string('bill_name');
            $table->string('bill_no');
            $table->string('biller_acc_no');
            $table->string('biller_mobile');
            $table->string('bill_from');
            $table->string('bill_to');
            $table->string('bill_gen_date');
            $table->string('bill_due_date');
            $table->string('charge');
            $table->string('bill_total_amount');
            $table->string('transaction_id');
            $table->string('payment_date');
            $table->string('payment_status');
            $table->string('payment_amount');
            $table->string('payment_trx_id');
            $table->string('payment_method');
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
        Schema::dropIfExists('commerce_bill_statuses');
    }
}
