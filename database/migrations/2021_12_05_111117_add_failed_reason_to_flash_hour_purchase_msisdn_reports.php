<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFailedReasonToFlashHourPurchaseMsisdnReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flash_hour_purchase_msisdn_reports', function (Blueprint $table) {
            $table->text('failed_reason')->after('action_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flash_hour_purchase_msisdn_reports', function (Blueprint $table) {
            $table->dropColumn('failed_reason');
        });
    }
}
