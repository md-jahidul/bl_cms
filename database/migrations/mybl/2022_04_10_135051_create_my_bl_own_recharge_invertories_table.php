<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlOwnRechargeInvertoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_own_recharge_invertories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description_bn');
            $table->string('description_en');
            $table->string('campaign_user_type');
            $table->unsignedBigInteger('base_msisdn_groups_id')->nullable()->index();
            $table->string('banner');
            $table->string('thumbnail_image');
            $table->json('partner_channel_names')->nullable();
            $table->string('purchase_eligibility');
            $table->string('recurring_type')->default('none');
            $table->integer('number_of_apply_times');
            $table->integer('max_amount');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('my_bl_own_recharge_invertories');
    }
}
