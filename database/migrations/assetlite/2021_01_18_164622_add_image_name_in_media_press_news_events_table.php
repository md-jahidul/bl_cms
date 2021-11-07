<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInMediaPressNewsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            if (!Schema::hasColumn('media_press_news_events', 'details_image_name_en')) {
                $table->string('details_image_name_en')->after('details_alt_text_bn')->nullable();
                $table->string('details_image_name_bn')->after('details_image_name_en')->nullable();
                $table->string('thumbnail_image_name_en')->after('thumbnail_image')->nullable();
                $table->string('thumbnail_image_name_bn')->after('thumbnail_image_name_en')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *l
     * @return void
     */
    public function down()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            if (Schema::hasColumn('media_press_news_events', 'details_image_name_en')) {
                $table->dropColumn('details_image_name_en');
                $table->dropColumn('details_image_name_bn');
                $table->dropColumn('thumbnail_image_name_en');
                $table->dropColumn('thumbnail_image_name_bn');
            }
        });
    }
}
