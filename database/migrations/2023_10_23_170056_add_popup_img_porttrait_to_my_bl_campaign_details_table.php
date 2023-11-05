<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPopupImgPorttraitToMyBlCampaignDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_campaign_details', function (Blueprint $table) {
            $table->string('popup_img_portrait')->after('popup_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_campaign_details', function (Blueprint $table) {
            $table->dropColumn('popup_img_portrait');
        });
    }
}
