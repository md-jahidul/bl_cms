<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageUrlFieldInQuickLaunchItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_launch_items', function (Blueprint $table) {
            $table->string('alt_text_bn')->nullable()->after('alt_text');
            $table->string('image_name_en')->nullable()->after('alt_text_bn');
            $table->string('image_name_bn')->nullable()->after('image_name_en');
            $table->string('link_bn')->nullable()->after('image_name_bn');
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
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('image_name_en');
            $table->dropColumn('image_name_bn');
            $table->dropColumn('link_bn');
        });
    }
}
