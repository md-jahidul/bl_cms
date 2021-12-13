<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlashHourPurchaseMsisdnReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_hour_purchase_msisdn_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_report_id');
            $table->string('msisdn')->nullable();
            $table->string('action_type')->nullable();
            $table->foreign('purchase_report_id')
                ->references('id')
                ->on('flash_hour_purchase_reports')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('flash_hour_purchase_msisdn_reports');
    }
}
