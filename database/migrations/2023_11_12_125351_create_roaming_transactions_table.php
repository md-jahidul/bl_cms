<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoamingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roaming_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn');
            $table->string('email')->nullable();
            $table->string('account_id');
            $table->enum('transaction_type', ['ROAMING_ACTIVE', 'ROAMING_PAYMENT']);
            $table->string('user_type');
            $table->string('transaction_id');
            $table->string('roaming_transaction_id')->nullable();
            $table->string('amount_bdt');
            $table->string('amount_usd');
            $table->string('session_id')->nullable();
            $table->string('bank_transaction_id')->nullable()->default(null);
            $table->string('transaction_status')->nullable();
            $table->string('val_id')->nullable()->default(null);
            $table->enum('status', ['PENDING', 'COMPLETE'])->nullable()->default(null);
            $table->enum('payment_initiated', ['0', '1']);
            $table->enum('payment_complete', ['0', '1'])->default('0');
            $table->json('barred_flags')->nullable();
            $table->enum('da_posting', ['0', '1'])->default('0');
            $table->enum('deposit', ['0', '1'])->nullable()->default(null);
            $table->enum('invoice_payment', ['0', '1'])->nullable()->default(null);
            $table->string('refund_ref_id')->nullable()->default(null);
            $table->enum('refund_initiated', ['INITIATED', 'FAILED'])->nullable()->default(null);
            $table->enum('refund_status', ['REFUNDED', 'IN_PROCESSING', 'CANCELLED'])->nullable()->default(null);
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
        Schema::dropIfExists('roaming_transactions');
    }
}
