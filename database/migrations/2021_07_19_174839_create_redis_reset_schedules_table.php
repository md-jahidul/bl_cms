<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedisResetSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redis_reset_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('redis_key_to_reset', 50)->nullable();
            $table->dateTime('start_at');
            $table->string('status', 15)->default('active');
            $table->integer('created_by');

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
        Schema::dropIfExists('redis_reset_schedules');
    }
}
