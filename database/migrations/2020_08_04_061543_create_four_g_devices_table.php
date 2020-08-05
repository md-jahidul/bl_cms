<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFourGDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('four_g_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('header_tag_id')->nullable();
            $table->json('body_tag_id')->nullable();
            $table->string('card_logo')->nullable();
            $table->string('logo_alt_text_en')->nullable();
            $table->string('logo_alt_text_bn')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('thumbnail_alt_text_en')->nullable();
            $table->string('thumbnail_alt_text_bn')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->integer('current_price')->nullable();
            $table->integer('old_price')->nullable();
            $table->string('view_details_url')->nullable();
            $table->string('buy_url')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('four_g_devices');
    }
}
