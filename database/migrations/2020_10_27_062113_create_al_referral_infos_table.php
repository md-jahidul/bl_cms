<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlReferralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_referral_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id')->nullable()->comment("App and service APP ID");
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->longText('details_en')->nullable();
            $table->longText('details_bn')->nullable();
            $table->foreign('app_id')
                ->references('id')
                ->on('app_service_products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('al_referral_infos');
    }
}
