<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleDescFieldInLmsAboutBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lms_about_banner_images', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('page_type');
            $table->string('title_bn')->nullable()->after('title_en');
            $table->string('desc_en')->nullable()->after('title_bn');
            $table->string('desc_bn')->nullable()->after('desc_en');
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
            $table->dropColumn('title_en');
            $table->dropColumn('title_bn');
            $table->dropColumn('desc_en');
            $table->dropColumn('desc_bn');
        });
    }
}
