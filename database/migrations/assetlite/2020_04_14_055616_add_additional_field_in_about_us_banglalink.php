<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInAboutUsBanglalink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            $table->string('banner_image_mobile')->nullable()->after('banglalink_info_bn');
            $table->string('banner_name', 200)->nullable()->after('banglalink_info_bn');
            $table->string('alt_text', 200)->nullable()->after('banglalink_info_bn');
            $table->string('url_slug')->nullable()->after('banglalink_info_bn');
            $table->text('page_header')->nullable()->after('banglalink_info_bn');
            $table->text('schema_markup')->nullable()->after('banglalink_info_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug');
            $table->dropColumn('banner_name');
            $table->dropColumn('alt_text');
            $table->dropColumn('banner_image_mobile');
        });
    }
}
