<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoColumnInMediaPressNewsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            $table->text('page_header')->nullable();
            $table->text('page_header_bn')->nullable();
            $table->text('schema_markup')->nullable();
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
            $table->removeColumn('page_header');
            $table->removeColumn('page_header_bn');
            $table->removeColumn('schema_markup');
        });
    }
}
