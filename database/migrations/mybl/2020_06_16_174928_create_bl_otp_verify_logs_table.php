<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBlOtpVerifyLogsTable
 */
class CreateBlOtpVerifyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_otp_verify_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('msisdn');
            $table->string('otp');
            $table->string('source')->nullable();
            $table->string('version')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('bl_otp_verify_logs');
    }
}
