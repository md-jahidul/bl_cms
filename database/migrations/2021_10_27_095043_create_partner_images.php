<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('logo_img')->nullable();
            $table->dateTime('upload_date')->nullable();
            $table->integer('uploaded_by')->nullable();
            $table->string('platform')->nullable();
            $table->integer('partner_category_id')->nullable();
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
        Schema::dropIfExists('partner_images');
    }
}
