<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpCaseStudyReportSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_case_study_report_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section_type')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->integer('display_order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corp_case_study_report_sections');
    }
}
