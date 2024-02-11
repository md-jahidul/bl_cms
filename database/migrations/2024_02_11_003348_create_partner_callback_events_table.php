<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerCallbackEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_callback_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn');
            $table->string('parent_msisdn')->nullable();
            $table->float('amount',8,2);
            $table->string('transaction_id')->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->string('status')->nullable();
            $table->string('callback_status')->nullable();
            $table->tinyInteger('is_callback_done')->default(0);
            $table->string('partner_name')->index();
            $table->string('type')->nullable();
            $table->string('reason')->nullable();
            $table->text('remarks')->nullable();
            $table->json('others_data')->nullable();
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
        Schema::dropIfExists('partner_callback_events');
    }
}