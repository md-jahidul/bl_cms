<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlBnFiledInPartnerOfferTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->string('url_slug_bn')->after('url_slug')->nullable()->unique();
            $table->string('image_name_en')->after('campaign_img')->nullable();
            $table->string('image_name_bn')->after('image_name_en')->nullable();
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
            //
        });
    }
}
