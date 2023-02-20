<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerNameInFourGLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('four_g_landing_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('four_g_landing_pages', 'banner_name_en')) {
                $table->string('banner_name_en')->after('items')->nullable();
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
        Schema::table('four_g_landing_pages', function (Blueprint $table) {
            if (Schema::hasColumn('four_g_landing_pages', 'banner_name_en')) {
                $table->dropColumn('banner_name_en');
                $table->dropColumn('banner_name_bn');
                $table->dropColumn('banner_image_url');
                $table->dropColumn('banner_mobile_view');
            }
        });
    }
}
