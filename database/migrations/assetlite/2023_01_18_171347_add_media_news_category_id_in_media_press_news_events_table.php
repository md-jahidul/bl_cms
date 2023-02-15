<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMediaNewsCategoryIdInMediaPressNewsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            $table->integer('media_news_category_id')->after('type')->nullable();
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
            $table->dropColumn('media_news_category_id');
        });
    }
}
