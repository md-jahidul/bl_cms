<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerTextInGenericSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generic_slider_images', function (Blueprint $table) {
            $table->string('banner_text_en')->nullable()->after('other_attributes');
            $table->string('banner_text_bn')->nullable()->after('banner_text_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generic_slider_images', function (Blueprint $table) {
            $table->dropColumn('banner_text_en');
            $table->dropColumn('banner_text_bn');
        });
    }
}
