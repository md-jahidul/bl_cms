<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlCampaignUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_campaign_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('my_bl_campaign_id');
            $table->unsignedBigInteger('my_bl_campaign_detail_id');
            $table->integer('msisdn')->index();
            $table->string('product_code')->index()->nullable();
            $table->integer('amount')->nullable();
            $table->double('discount_amount', 8, 2)->nullable();
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
        Schema::dropIfExists('my_bl_campaign_users');
    }
}
