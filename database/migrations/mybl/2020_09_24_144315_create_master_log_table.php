<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn',20);
            $table->date('date')->nullable(true);
            $table->longText('data')->nullable(true);
            $table->longText('response')->nullable(true);
            $table->string('message')->nullable(true);
            $table->integer('status')->nullable(false);
            $table->string('log_type',100)->nullable(false);
            $table->string('device_id')->nullable(true);
            $table->string('others')->nullable(true);
            $table->string('ip_address',20)->nullable(true);
            $table->string('browse_url')->nullable(true);
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
        Schema::dropIfExists('master_logs');
    }
}
