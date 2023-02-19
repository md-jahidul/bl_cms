<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            $table->uuid('uid')->default(DB::raw('(UUID())'))->primary();
            $table->string('result')->nullable();
            $table->string('message')->nullable();
            $table->string('bill_payment_id')->nullable();
            $table->string('bill_refer_id')->nullable();
            $table->string('biller_id')->nullable();
            $table->string('bill_name')->nullable();
            $table->string('bill_no')->nullable();
            $table->string('biller_acc_no')->nullable();
            $table->string('biller_mobile')->nullable();
            $table->string('bill_from')->nullable();
            $table->string('bill_to')->nullable();
            $table->string('bill_gen_date')->nullable();
            $table->string('bill_due_date')->nullable();
            $table->string('charge')->nullable();
            $table->string('bill_total_amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_trx_id')->nullable();
            $table->string('payment_method')->nullable();
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
