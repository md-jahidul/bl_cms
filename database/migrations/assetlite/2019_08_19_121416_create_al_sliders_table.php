<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('component_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('short_code');
            $table->string('slider_type')->default('single');                         // single, multiple 
            $table->json('other_attributes')->nullable();
            $table->foreign('component_id')
                    ->references('id')
                    ->on('al_slider_component_types')
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
        Schema::dropIfExists('al_sliders');
    }
}
