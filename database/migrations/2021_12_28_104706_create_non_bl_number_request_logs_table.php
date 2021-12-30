<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonBlNumberRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_bl_number_request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn')->nullable();
            $table->string('device_id')->nullable();
            $table->string('failed_massage')->nullable();
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
        Schema::dropIfExists('non_bl_number_request_logs');
    }
}
