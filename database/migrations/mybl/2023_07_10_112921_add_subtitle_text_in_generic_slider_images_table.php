<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubtitleTextInGenericSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generic_slider_images', function (Blueprint $table) {
            $table->string('subtitle_text_en')->nullable()->after('banner_text_bn');
            $table->string('subtitle_text_bn')->nullable()->after('subtitle_text_en');
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
            $table->dropColumn('subtitle_text_en');
            $table->dropColumn('subtitle_text_bn');
        });
    }
}
