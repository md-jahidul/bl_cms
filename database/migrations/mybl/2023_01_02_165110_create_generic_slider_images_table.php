<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_slider_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('generic_slider_id');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('image_url');
            $table->string('alt_text');
            $table->string('user_type');
            $table->string('url_btn_label')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('web_deep_link')->nullable();
            $table->string('sequence')->nullable();
            $table->boolean('status')->default(1);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('display_type')->nullable();
            $table->string('ussd_code')->nullable();
            $table->string('message_en')->nullable();
            $table->string('message_bn')->nullable();
            $table->json('other_attributes')->nullable();
            $table->timestamps();
            $table->foreign('generic_slider_id')
                ->references('id')
                ->on('generic_sliders')
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
        Schema::dropIfExists('generic_slider_images');
    }
}
