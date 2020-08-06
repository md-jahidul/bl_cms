<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerImageMobileInAppServiceProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_product_details', function (Blueprint $table) {
            $table->string('banner_name')->nullable()->after('title_bn');
            $table->string('banner_image_mobile')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_product_details', function (Blueprint $table) {
            $table->dropColumn('banner_name');
            $table->dropColumn('banner_image_mobile');
        });
    }
}
