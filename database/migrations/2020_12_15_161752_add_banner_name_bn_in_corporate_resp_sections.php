<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerNameBnInCorporateRespSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corporate_resp_sections', function (Blueprint $table) {
            $table->string('banner_image_name_bn')->after('banner_image_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corporate_resp_sections', function (Blueprint $table) {
            $table->dropColumn('banner_image_name_bn');
        });
    }
}
