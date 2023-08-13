<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeeplinkToGenericSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generic_slider_images', function (Blueprint $table) {
            $table->string('deeplink')->nullable()->after('web_deep_link');
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
            $table->dropColumn('deeplink');
        });
    }
}
