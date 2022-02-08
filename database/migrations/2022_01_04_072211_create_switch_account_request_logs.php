<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchAccountRequestLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switch_account_request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_msisdn', 20);
            $table->string('to_msisdn', 20);
            $table->string('status', 10);
            $table->string('message', 100);
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
        Schema::dropIfExists('switch_account_request_logs');
    }
}
