<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('partner_id');
            $table->string('product_code')->nullable();
            $table->string('validity_en');
            $table->string('validity_bn');
            $table->string('offer_en');
            $table->string('offer_bn');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('get_offer_msg_en');
            $table->string('get_offer_msg_bn');
            $table->string('btn_text_en');
            $table->string('btn_text_bn');
            $table->string('campaign_img')->nullable();
            $table->tinyInteger('is_campaign')->default(0);
            $table->tinyInteger('show_in_home')->default(0);
            $table->tinyInteger('is_active');
            $table->integer('display_order')->default(0);
            $table->integer('campaign_order')->default(0);
            $table->json('other_attributes')->nullable();
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
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
        Schema::dropIfExists('partner_offers');
    }
}
