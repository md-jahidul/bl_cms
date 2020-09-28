<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpCrStrategyComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_cr_strategy_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_type')->nullable();
            $table->integer('page_id')->nullable();
            $table->string('component_type')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('details_en')->nullable();
            $table->string('details_bn')->nullable();
            $table->json('other_attributes')->nullable();
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
        Schema::dropIfExists('corp_cr_strategy_components');
    }
}
