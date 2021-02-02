<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpCaseStudyDetailsBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_case_study_details_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('details_id')->nullable();
            $table->string('banner_web')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('image_name_en')->nullable();
            $table->string('image_name_bn')->nullable();

            $table->foreign('details_id')
                ->references('id')
                ->on('corp_case_study_report_components')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('corp_case_study_details_banners');
    }
}
