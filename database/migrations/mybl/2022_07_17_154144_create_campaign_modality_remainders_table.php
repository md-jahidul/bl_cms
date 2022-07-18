<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignModalityRemaindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_modality_remainders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('my_bl_campaign_id');
            $table->unsignedBigInteger('my_bl_campaign_detail_id');
            $table->string('msisdn');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('campaign_modality_remainders');
    }
}
