<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleSubtitleAttributesBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->string('banner_title_en')->after('name_bn')->nullable();
            $table->string('banner_title_bn')->after('name_bn')->nullable();
            $table->text('banner_subtitle_en')->after('name_bn')->nullable();
            $table->text('banner_subtitle_bn')->after('name_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->dropColumn('banner_title_en');
            $table->dropColumn('banner_title_bn');
            $table->dropColumn('banner_subtitle_en');
            $table->dropColumn('banner_subtitle_bn');
        });
    }
}
