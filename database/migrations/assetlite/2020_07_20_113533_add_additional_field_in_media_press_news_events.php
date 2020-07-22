<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInMediaPressNewsEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            $table->string('details_image')->after('long_details_bn')->nullable();
            $table->string('details_alt_text_en')->after('details_image')->nullable();
            $table->string('details_alt_text_bn')->after('details_alt_text_en')->nullable();
            $table->string('status')->after('details_alt_text_bn')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->renameColumn('image_url', 'thumbnail_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            $table->dropColumn('details_image');
            $table->dropColumn('details_alt_text_en');
            $table->dropColumn('details_alt_text_bn');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('status');
            $table->renameColumn('thumbnail_image', 'image_url');
        });
    }
}
