<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpIntBatchComponentTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corp_int_batch_component_tabs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('corp_int_tab_com_id')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();

            $table->foreign('corp_int_tab_com_id')
                ->references('id')
                ->on('corp_initiative_tab_components')
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
        Schema::dropIfExists('corp_int_batch_component_tabs');
    }
}
