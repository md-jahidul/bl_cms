<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('section_id')->default(0);
            $table->string('section_type')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_bn')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('image_name_en')->nullable();
            $table->string('image_name_bn')->nullable();
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
        Schema::dropIfExists('al_banners');
    }
}
