<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignPurchaseMsisdnReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_purchase_msisdn_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_report_id');
            $table->integer('msisdn')->index();
            $table->string('action_type', 50)->index();
            $table->text('failed_reason')->nullable();
            $table->timestamps();
            $table->foreign('purchase_report_id')
                ->references('id')
                ->on('campaign_purchase_reports')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_purchase_msisdn_reports');
    }
}
