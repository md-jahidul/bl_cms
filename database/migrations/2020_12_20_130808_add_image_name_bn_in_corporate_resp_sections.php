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
            $table->string('image_base_url')->nullable()->after('url_slug_bn');
            $table->string('image_name_en')->nullable()->after('image_base_url');
            $table->string('image_name_bn')->nullable()->after('image_name_en');
            $table->string('banner_image_web')->nullable()->after('image_name_bn');
            $table->string('banner_image_mobile')->nullable()->after('banner_image_web');
            $table->string('banner_name_en')->nullable()->after('banner_image_mobile');
            $table->string('banner_name_bn')->nullable()->after('banner_name_en');
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
            $table->dropColumn('image_base_url');
            $table->dropColumn('image_name_en');
            $table->dropColumn('image_name_bn');
            $table->dropColumn('banner_image_web');
            $table->dropColumn('banner_image_mobile');
            $table->dropColumn('banner_name_en');
            $table->dropColumn('banner_name_bn');
        });
    }
}
