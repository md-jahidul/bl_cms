<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlStoreSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_store_slider_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_app_id');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('image_url');
            $table->string('alt_text');
            $table->string('url_btn_label')->nullable();
            $table->string('redirect_url')->nullable();
            $table->integer('sequence')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->json('other_attributes')->nullable();
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
        Schema::dropIfExists('my_bl_store_slider_images');
    }
}
