<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddConnectionTypeToMyBlSearchContentsTable
 */
class AddConnectionTypeToMyBlSearchContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_search_contents', function (Blueprint $table) {
            $table->string('connection_type')->after('is_default')->default('prepaid');
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
            $table->dropColumn('connection_type');
        });
    }
}
