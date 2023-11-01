<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRneBonusTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rne_bonus_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->unique();
            $table->tinyInteger('referrer_status');
            $table->tinyInteger('referee_status');
            $table->string('referrer_msisdn');
            $table->string('referee_msisdn');
            $table->string('referrer_product_code');
            $table->string('referee_product_code');
            $table->enum('status', ['pending', 'completed', 'inqueue', 'partial', 'failed'])->index();
            $table->integer('retry_count')->default(0);
            $table->timestamp('referrer_disbursement_time')->nullable();
            $table->timestamp('referee_disbursement_time')->nullable();
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
        Schema::dropIfExists('rne_bonus_transactions');
    }
}
