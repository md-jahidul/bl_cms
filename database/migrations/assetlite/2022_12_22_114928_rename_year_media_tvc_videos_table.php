<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameYearMediaTvcVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_tvc_videos', function (Blueprint $table) {
            $table->renameColumn('year', 'year_en');
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
            $table->renameColumn('year_en', 'year');
        });
    }
}
