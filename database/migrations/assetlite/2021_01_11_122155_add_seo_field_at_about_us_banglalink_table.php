<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldAtAboutUsBanglalinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
           if (!Schema::hasColumn('about_us_banglalink', 'page_header_bn')) {
               $table->string('page_header_bn')->after('page_header')->nullable();
               $table->string('url_slug_bn')->after('url_slug')->nullable();
               $table->string('alt_text_bn')->after('alt_text')->nullable();
               $table->string('banner_name_bn')->after('banner_name')->nullable();
               $table->string('content_img_name')->after('content_image')->nullable();
               $table->string('content_img_name_bn')->after('content_img_name')->nullable();
               $table->string('content_img_alt_text')->after('content_img_name_bn')->nullable();
               $table->string('content_img_alt_text_bn')->after('content_img_alt_text')->nullable();
           }
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
            if (Schema::hasColumn('about_us_banglalink', 'page_header_bn')) {
                $table->dropColumn('page_header_bn');
                $table->dropColumn('url_slug_bn');
                $table->dropColumn('alt_text_bn');
                $table->dropColumn('banner_name_bn');
                $table->dropColumn('content_img_name');
                $table->dropColumn('content_img_name_bn');
                $table->dropColumn('content_img_alt_text');
                $table->dropColumn('content_img_alt_text_bn');
            }
        });
    }
}
