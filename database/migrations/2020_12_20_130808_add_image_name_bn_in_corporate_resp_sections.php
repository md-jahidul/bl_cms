<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameBnInCorporateRespSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corp_cr_strategy_components', function (Blueprint $table) {
            $table->string('image_name_en')->nullable()->after('url_slug_bn');
            $table->string('image_name_bn')->nullable()->after('image_name_en');
            $table->string('banner_image_en')->nullable()->after('image_name_bn');
            $table->string('banner_image_bn')->nullable()->after('banner_image_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corp_cr_strategy_components', function (Blueprint $table) {
            $table->dropColumn('image_name_en');
            $table->dropColumn('image_name_en');
            $table->dropColumn('banner_image_en');
            $table->dropColumn('banner_image_bn');
        });
    }
}
