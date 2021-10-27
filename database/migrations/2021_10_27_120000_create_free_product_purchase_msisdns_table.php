<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeProductPurchaseMsisdnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_product_purchase_msisdns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_report_id');
            $table->string('msisdn', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->text('failed_reason')->nullable();
            $table->foreign('purchase_report_id')
                ->references('id')
                ->on('free_product_purchase_reports')
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
        Schema::dropIfExists('free_product_purchase_msisdns');
    }
}
