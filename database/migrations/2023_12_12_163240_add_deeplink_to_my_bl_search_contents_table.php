<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeeplinkToMyBlSearchContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_search_contents', function (Blueprint $table) {
            $table->string('deeplink')->after('connection_type')->nullable();
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
            $table->dropColumn('deeplink');
        });
    }
}
