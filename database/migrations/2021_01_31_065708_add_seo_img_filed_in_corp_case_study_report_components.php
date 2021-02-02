<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoImgFiledInCorpCaseStudyReportComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corp_case_study_report_components', function (Blueprint $table) {
            $table->string('base_image')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('image_name_en')->nullable();
            $table->string('image_name_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corp_case_study_report_components', function (Blueprint $table) {
            $table->dropColumn('base_image');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('image_name_en');
            $table->dropColumn('image_name_bn');
        });
    }
}
