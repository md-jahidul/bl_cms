<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileViewImgColumnSliderImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_slider_images', function (Blueprint $table) {
            $table->string('mobile_view_img')->nullable()->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('al_slider_images', function (Blueprint $table) {
            $table->dropColumn('mobile_view_img');
        });
    }
}
