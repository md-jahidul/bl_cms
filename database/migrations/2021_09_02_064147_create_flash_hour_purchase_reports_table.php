<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlashHourPurchaseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_hour_purchase_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mybl_flash_hours_id')->nullable();
            $table->string('product_code')->nullable();
            $table->foreign('mybl_flash_hours_id')
                ->references('id')
                ->on('mybl_flash_hours')
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
        Schema::dropIfExists('flash_hour_purchase_reports');
    }
}
