<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsBenifitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_benifits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_type')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('image_url')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->integer('display_order')->nullable();
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
        Schema::dropIfExists('lms_benifits');
    }
}
