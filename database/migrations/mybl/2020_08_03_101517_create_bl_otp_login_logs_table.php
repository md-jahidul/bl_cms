<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlOtpLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_otp_login_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->nullable();
            $table->json('data')->nullable();
            $table->json('others')->nullable();
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
        Schema::dropIfExists('bl_otp_login_logs');
    }
}
