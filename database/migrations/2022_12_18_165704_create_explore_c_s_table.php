<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExploreCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explore_c_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->text('short_desc_en')->nullable();
            $table->text('short_desc_bn')->nullable();
            $table->string('button_lable_en')->nullable();
            $table->string('button_lable_bn')->nullable();
            $table->string('button_url_en')->nullable();
            $table->string('button_url_bn')->nullable();
            $table->string('img')->nullable();
            $table->string('img_alt_en')->nullable();
            $table->string('img_alt_bn')->nullable();
            $table->string('img_name_en')->nullable();
            $table->string('img_name_bn')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('display_order')->nullable();

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
        Schema::dropIfExists('explore_c_s');
    }
}
