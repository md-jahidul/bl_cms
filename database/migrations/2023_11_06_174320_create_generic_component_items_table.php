<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericComponentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_component_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('component_key');
            $table->string('title_en');
            $table->string('title_bn');
            $table->integer('display_order');
            $table->boolean('is_api_call_enable')->default(1);
            $table->boolean('is_eligible')->default(1);
            $table->bigInteger('android_version_code_min')->default(0);
            $table->bigInteger('android_version_code_max')->default(999999999);
            $table->bigInteger('ios_version_code_min')->default(0);
            $table->bigInteger('ios_version_code_max')->default(999999999);
            $table->unsignedBigInteger('generic_component_id');
            $table->unsignedBigInteger('generic_slider_id')->nullable();
            $table->foreign('generic_component_id')
                ->references('id')
                ->on('generic_components')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('generic_slider_id')
                ->references('id')
                ->on('generic_sliders')
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
        Schema::dropIfExists('generic_component_items');
    }
}
