<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeInQuickLaunchItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_launch_items', function (Blueprint $table) {
            $table->string('type')->nullable()->after('link');
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
            $table->dropColumn('type');
        });
    }
}
