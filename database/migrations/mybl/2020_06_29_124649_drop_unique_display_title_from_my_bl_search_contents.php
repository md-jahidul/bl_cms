<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueDisplayTitleFromMyBlSearchContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_search_contents', function (Blueprint $table) {
            $table->dropUnique('my_bl_search_contents_display_title_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_search_contents', function (Blueprint $table) {
            $table->string('display_title')->unique()->change();
        });
    }
}
