<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtpTokenBlOtpVerifyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bl_otp_verify_logs', function (Blueprint $table) {
            $table->string('otp_token')->nullable()->after('otp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bl_otp_verify_logs', function (Blueprint $table) {
            $table->dropColumn('otp_token');
        });
    }
}
