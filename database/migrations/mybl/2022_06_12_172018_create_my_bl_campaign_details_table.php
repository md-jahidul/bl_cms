<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlCampaignDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_campaign_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('my_bl_campaign_id');
            $table->integer('recharge_amount')->nullable();
            $table->integer('cash_back_amount')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('thumb_image')->nullable();
            $table->string('popup_image')->nullable();
            $table->string('cash_back_type')->nullable();
            $table->integer('number_of_apply_times')->nullable();
            $table->integer('max_amount')->nullable();
            $table->string('purchase_eligibility')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_for')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_bn')->nullable();
            $table->string('product_category_slug')->nullable();
            $table->boolean('show_in_home')->default(0);
            $table->string('show_product_as')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('my_bl_campaign_details');
    }
}
