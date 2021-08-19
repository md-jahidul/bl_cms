<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblFlashHourRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_flash_hour_reminders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('flash_hour_id');
            $table->unsignedBigInteger('flash_hour_product_id');
            $table->string('msisdn')->nullable();

            $table->foreign('flash_hour_id')
                ->references('id')
                ->on('mybl_flash_hours')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('flash_hour_product_id')
                ->references('id')
                ->on('mybl_flash_hour_products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('mybl_flash_hour_reminders');
    }
}
