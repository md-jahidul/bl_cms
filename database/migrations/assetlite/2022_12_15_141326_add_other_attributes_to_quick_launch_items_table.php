<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherAttributesToQuickLaunchItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_launch_items', function (Blueprint $table) {
            $table->longtext('other_attributes')->after('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quick_launch_items', function (Blueprint $table) {
            $table->dropColumn('other_attributes');
        });
    }
}
