<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeeplinkToContentNavigationRailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_navigation_rails', function (Blueprint $table) {
            $table->string('deeplink')->nullable()->after('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_navigation_rails', function (Blueprint $table) {
            $table->dropColumn('deeplink');
        });
    }
}
