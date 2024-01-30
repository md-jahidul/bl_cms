<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnInPartnerOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->mediumText('get_offer_msg_en')->change();
            $table->mediumText('get_offer_msg_bn')->change();
            $table->mediumText('location')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->string('get_offer_msg_en')->change();
            $table->string('get_offer_msg_bn')->change();
            $table->string('location')->change();
        });
    }
}
