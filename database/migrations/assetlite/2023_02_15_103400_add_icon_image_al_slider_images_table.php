<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconImageAlSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_slider_images', function (Blueprint $table) {
            $table->string('icon_image')->after('title_en')->nullable();
            $table->string('icon_alt_text_en')->after('title_en')->nullable();
            $table->string('icon_alt_text_bn')->after('title_en')->nullable();
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
            $table->dropColumn('icon_image');
            $table->dropColumn('icon_alt_text_en');
            $table->dropColumn('icon_alt_text_bn');
        });
    }
}
