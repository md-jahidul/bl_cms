<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageAndVideoFieldInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->tinyInteger('is_images')->after('page_header_bn')->default(0);
            $table->string('details_image_url')->after('page_header_bn')->nullable();
            $table->string('details_video_url')->after('page_header_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->dropColumn('is_images');
            $table->dropColumn('details_image_url');
            $table->dropColumn('details_video_url');
        });
    }
}
