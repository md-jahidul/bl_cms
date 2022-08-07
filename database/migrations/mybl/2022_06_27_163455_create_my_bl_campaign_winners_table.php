<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlCampaignWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_campaign_winners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('my_bl_campaign_id');
            $table->unsignedBigInteger('my_bl_campaign_detail_id');
            $table->integer('msisdn');
            $table->string('product_code', 50)->nullable();
            $table->integer('recharge_amount')->nullable();
            $table->string('bonus_product_code', 50)->nullable();
            $table->dateTime('winning_slot_start')->index();
            $table->dateTime('winning_slot_end')->index();
            $table->timestamps();
            $table->foreign('my_bl_campaign_id')
                ->references('id')
                ->on('my_bl_campaigns')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('my_bl_campaign_detail_id')
                ->references('id')
                ->on('my_bl_campaign_details')
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
        Schema::dropIfExists('my_bl_campaign_winners');
    }
}
