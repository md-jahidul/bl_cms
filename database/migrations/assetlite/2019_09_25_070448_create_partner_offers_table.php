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
            $table->string('validity_en');
            $table->string('validity_bn');
            $table->string('offer_en');
            $table->string('offer_bn');
            $table->string('get_offer_msg_en');
            $table->string('get_offer_msg_bn');
            $table->string('btn_text_en');
            $table->string('btn_text_bn');
            $table->tinyInteger('show_in_home')->default(0);
            $table->tinyInteger('is_active');
            $table->string('display_order');
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
