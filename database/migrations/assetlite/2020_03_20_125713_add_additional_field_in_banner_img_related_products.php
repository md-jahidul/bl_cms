<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInBannerImgRelatedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner_img_related_products', function (Blueprint $table) {
            $table->string('mobile_view_img_url')->nullable()->after('banner_image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner_img_related_products', function (Blueprint $table) {
            $table->dropColumn('mobile_view_img_url');
        });
    }
}
