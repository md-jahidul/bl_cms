<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldAtMediaBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_banner_images', function (Blueprint $table) {
            if (!Schema::hasColumn('media_banner_images', 'page_header')) {
                $table->string('banner_name_en')->after('alt_text_en')->nullable();
                $table->string('banner_name_bn')->after('banner_name_en')->nullable();
                $table->text('page_header')->after('banner_name_bn')->nullable();
                $table->text('page_header_bn')->after('page_header')->nullable();
                $table->text('schema_markup')->after('page_header_bn')->nullable();
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
        Schema::table('media_banner_images', function (Blueprint $table) {
            if (Schema::hasColumn('media_banner_images', 'page_header')) {
                $table->dropColumn('page_header');
                $table->dropColumn('page_header_bn');
                $table->dropColumn('schema_markup');
                $table->dropColumn('banner_name_en');
                $table->dropColumn('banner_name_bn');
            }
        });
    }
}
