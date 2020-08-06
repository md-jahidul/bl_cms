<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldInBannerImgRelatedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner_img_related_products', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('alt_text');
            $table->text('schema_markup')->nullable()->after('alt_text');
            $table->string('url_slug')->nullable()->after('alt_text');
            $table->string('banner_name', 200)->nullable()->after('alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner_img_related_products', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug');
            $table->dropColumn('banner_name');
        });
    }
}
