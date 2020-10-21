<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpCaseStudyReportComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_case_study_report_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('section_id')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('details_en')->nullable();
            $table->string('details_bn')->nullable();
            $table->json('other_attributes')->nullable();
            $table->json('banner')->nullable();
            $table->text('url_slug_en')->nullable();
            $table->text('url_slug_bn')->nullable();
            $table->longText('page_header')->nullable();
            $table->longText('page_header_bn')->nullable();
            $table->longText('schema_markup')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('display_order')->default(0);
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
        Schema::dropIfExists('corp_case_study_report_components');
    }
}
