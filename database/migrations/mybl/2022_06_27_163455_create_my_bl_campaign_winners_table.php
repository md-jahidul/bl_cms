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
            $table->integer('msisdn');
            $table->string('product_code', 50);
            $table->dateTime('winning_slot_start')->index();
            $table->dateTime('winning_slot_end')->index();
            $table->timestamps();
            $table->foreign('my_bl_campaign_id')
                ->references('id')
                ->on('my_bl_campaigns')
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
