<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DoctimeTransactionStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('post-transaction-status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contact_no')->index();
            $table->enum('service', ['consultation', 'subscription_purchase', 'diagnostic_order','medicine_order']);
            $table->unsignedBigInteger('service_id');
            $table->float('amount',15,2);
            $table->string('payment_status');
            $table->timestamp('transaction_time');
            $table->string('transaction_id');
            $table->text('remarks')->nullable();
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
        //
    }
}
