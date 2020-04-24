<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExternalLinkCheckFieldQuickLaunchItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_launch_items', function (Blueprint $table) {
            $table->tinyInteger('is_external_link')->default(0)->after('link');
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
            $table->dropColumn('is_external_link');
        });
    }
}
