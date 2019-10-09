<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_slider_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('slider_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('image_url');
            $table->string('alt_text');
            $table->integer('display_order')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->json('other_attributes')->nullable();
            $table->timestamps();

            $table->foreign('slider_id')
                ->references('id')
                ->on('al_sliders')
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
        Schema::dropIfExists('al_slider_images');
    }
}
