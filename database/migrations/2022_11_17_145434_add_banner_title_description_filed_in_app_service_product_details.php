<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerTitleDescriptionFiledInAppServiceProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_product_details', function (Blueprint $table) {
            $table->string('banner_title_en')->after('banner_image_mobile')->nullable();
            $table->string('banner_title_bn')->after('banner_title_en')->nullable();
            $table->text('banner_desc_en')->after('banner_title_bn')->nullable();
            $table->text('banner_desc_bn')->after('banner_desc_en')->nullable();
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
            $table->dropColumn('banner_title_en');
            $table->dropColumn('banner_title_bn');
            $table->dropColumn('banner_desc_en');
            $table->dropColumn('banner_desc_bn');
        });
    }
}
