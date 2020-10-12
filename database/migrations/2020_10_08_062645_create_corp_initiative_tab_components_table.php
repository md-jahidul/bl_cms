<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpInitiativeTabComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_initiative_tab_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('initiative_tab_id')->nullable();
            $table->string('component_type')->nullable();
            $table->string('component_title_en')->nullable();
            $table->string('component_title_bn')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->longText('editor_en')->nullable();
            $table->longText('editor_bn')->nullable();
            $table->json('multiple_attributes')->nullable();
            $table->integer('component_order')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->foreign('initiative_tab_id')
                ->references('id')
                ->on('corp_initiative_tabs')
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
        Schema::dropIfExists('corp_initiative_tab_components');
    }
}
