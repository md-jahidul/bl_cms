<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterSearchContentsToMyBlSearchContentsTable
 */
class AlterSearchContentsToMyBlSearchContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_search_contents', function (Blueprint $table) {
            $table->mediumText('search_content')->change();
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
            $table->json('search_content')->change();
        });
    }
}
