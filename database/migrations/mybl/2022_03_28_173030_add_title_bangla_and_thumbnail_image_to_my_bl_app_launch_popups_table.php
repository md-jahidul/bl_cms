<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleBanglaAndThumbnailImageToMyBlAppLaunchPopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_app_launch_popups', function (Blueprint $table) {
            $table->string('thumbnail')->after('product_code')->nullable();
            $table->string('title_bn')->after('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_app_launch_popups', function (Blueprint $table) {
            $table->dropColumn('thumbnail_image');
            $table->dropColumn('title_bn');
        });
    }
}
