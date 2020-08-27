<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlContactRestoreLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_contact_restore_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contact_backup_id');
            $table->text('message');
            $table->string('date_time')->nullable();
            $table->string('platform')->nullable();
            $table->string('device_os')->nullable();
            $table->string('device_model')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('total_number_to_be_restore')->nullable();
            $table->string('total_restore')->nullable();
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
        Schema::dropIfExists('my_bl_contact_restore_logs');
    }
}
