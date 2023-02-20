<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYearLabelToMediaTvcVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_tvc_videos', function (Blueprint $table) {
            $table->string('year')->after('video_url')->nullable();
            $table->string('year_bn')->after('video_url')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_tvc_videos', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('year_bn');

        });
    }
}
