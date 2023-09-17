<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlLabStartupInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_lab_startup_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bl_lab_app_id');
            $table->mediumText('problem_identification')->nullable();
            $table->string('big_idea')->nullable();
            $table->string('target_group')->nullable();
            $table->string('market_size')->nullable();
            $table->string('business_model')->nullable();
            $table->text('business_model_file')->nullable();
            $table->mediumText('gtm_plan')->nullable();
            $table->text('gtm_plan_file')->nullable();
            $table->string('financial_metrics')->nullable();
            $table->text('financial_metrics_file')->nullable();
            $table->boolean('exist_product_service')->nullable();
            $table->string('exist_product_service_details')->nullable();
            $table->string('exist_product_service_diff')->nullable();
            $table->boolean('receive_fund')->nullable();
            $table->string('receive_fund_source')->nullable();
            $table->string('startup_current_stage')->nullable();
            $table->mediumText('other_attr')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->foreign('bl_lab_app_id')
                ->references('id')
                ->on('bl_lab_applications')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bl_lab_startup_infos');
    }
}
