<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerImaheFieldProductDetailsSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details_sections', function (Blueprint $table) {
            $table->string('banner_image_url')->nullable()->after('title_bn');
            $table->string('banner_mobile_view')->nullable()->after('banner_image_url');
            $table->string('alt_text')->nullable()->after('banner_mobile_view');
            $table->string('banner_name')->nullable()->after('alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details_sections', function (Blueprint $table) {
            $table->dropColumn('banner_image_url');
            $table->dropColumn('banner_mobile_view');
            $table->dropColumn('alt_text');
            $table->dropColumn('banner_name');
        });
    }
}
