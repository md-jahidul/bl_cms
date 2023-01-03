<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInMediaPressNewsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_press_news_events', function (Blueprint $table) {
            $table->string('reference_type')->nullable()->after('id');
            $table->integer('reference_id')->nullable()->after('reference_type');
            $table->tinyInteger('show_in_home')->default(0)->after('status');
            $table->integer('read_time')->default(0)->after('date');
            $table->string('details_btn_en')->nullable()->after('details_image_name_bn');
            $table->string('details_btn_bn')->nullable()->after('details_btn_en');
            $table->string('tag_en')->nullable()->after('alt_text_bn');
            $table->string('tag_bn')->nullable()->after('tag_en');
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
            $table->dropColumn('reference_type');
            $table->dropColumn('reference_id');
            $table->dropColumn('show_in_home');
            $table->dropColumn('read_time');
            $table->dropColumn('details_btn_en');
            $table->dropColumn('details_btn_bn');
            $table->dropColumn('tag_en');
            $table->dropColumn('tag_bn');
        });
    }
}
