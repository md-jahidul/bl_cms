<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnBlOtpLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bl_otp_login_logs', function (Blueprint $table) {
            $table->string('status_code_header')->nullable()->after('status');
            $table->string('response_message')->nullable()->after('status_code_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bl_otp_login_logs', function (Blueprint $table) {
            $table->dropColumn('status_code_header');
            $table->dropColumn('status_code_header');
        });
    }
}
