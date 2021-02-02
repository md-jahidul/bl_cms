<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerNameInBanglalinkThreeGSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banglalink_three_g_s', function (Blueprint $table) {
            if (!Schema::hasColumn('banglalink_three_g_s', 'banner_name_en')) {
                $table->string('banner_name_en')->after('other_attributes')->nullable();
                $table->string('banner_name_bn')->after('banner_name_en')->nullable();
                $table->string('banner_image_url')->after('banner_name_bn')->nullable();
                $table->string('banner_mobile_view')->after('banner_image_url')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banglalink_three_g_s', function (Blueprint $table) {
            if (Schema::hasColumn('banglalink_three_g_s', 'banner_name_en')) {
                $table->dropColumn('banner_name_en');
                $table->dropColumn('banner_name_bn');
                $table->dropColumn('banner_image_url');
                $table->dropColumn('banner_mobile_view');
            }
        });
    }
}
