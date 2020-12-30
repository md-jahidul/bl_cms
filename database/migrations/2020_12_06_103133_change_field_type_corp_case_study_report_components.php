<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldTypeCorpCaseStudyReportComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corp_case_study_report_components', function (Blueprint $table) {
            $table->longText('details_en')->change();
            $table->longText('details_bn')->change();
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
            //
        });
    }
}
