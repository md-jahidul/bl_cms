<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBannerVideoUrlAndIsImageAtPriyojonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            $table->string('banner_video_url')->nullable()->after('banner_image_url');
            $table->tinyInteger('is_images')->default(1)->after('banner_video_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            $table->dropColumn('banner_video_url');
            $table->dropColumn('is_images');
        });
    }
}
