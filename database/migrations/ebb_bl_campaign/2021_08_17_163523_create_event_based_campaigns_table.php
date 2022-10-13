<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBasedCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_based_campaigns', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('title');
            $table->string('description');
            $table->string('description_bn');
            $table->integer('base_msisdn_id')->nullable();
            $table->string('icon_image');
            $table->string('reward_product_code_prepaid', 30)->nullable();
            $table->string('reward_product_code_postpaid', 30)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(true);
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();
            $table->string('campaign_user_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_based_campaigns');
    }
}
