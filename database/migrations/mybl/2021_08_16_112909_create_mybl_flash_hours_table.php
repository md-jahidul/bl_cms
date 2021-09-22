<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblFlashHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_flash_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('base_msisdn_groups_id')->nullable()->index();
            $table->string('reference_type')->nullable();
            $table->string('title')->nullable();
            $table->dateTime('start_date')->nullable()->index();
            $table->dateTime('end_date')->nullable()->index();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('mybl_flash_hours');
    }
}
