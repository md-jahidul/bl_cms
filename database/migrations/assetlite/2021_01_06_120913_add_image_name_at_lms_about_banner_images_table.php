<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameAtLmsAboutBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lms_about_banner_images', function (Blueprint $table) {
            if (!Schema::hasColumn('lms_about_banner_images', 'banner_name_bn')) {
                $table->string('banner_name_bn')->after('banner_name')->nullable();
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
        Schema::table('lms_about_banner_images', function (Blueprint $table) {
            if (Schema::hasColumn('lms_about_banner_images', 'banner_name_bn')) {
                $table->dropColumn('banner_name_bn');
            }
        });
    }
}
