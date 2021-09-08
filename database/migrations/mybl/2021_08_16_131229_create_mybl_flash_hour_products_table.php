<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblFlashHourProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_flash_hour_products', function (Blueprint $table) {
            $table->unsignedBigInteger('flash_hour_id');
            $table->string('product_code')->nullable();
            $table->string('product_type')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_bn')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('flash_hour_id')
                ->references('id')
                ->on('mybl_flash_hours')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mybl_flash_hour_products');
    }
}
