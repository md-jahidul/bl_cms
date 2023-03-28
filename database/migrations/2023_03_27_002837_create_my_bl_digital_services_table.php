<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlDigitalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_digital_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('header_title_en');
            $table->string('header_title_bn');
            $table->text('header_sub_title_en')->nullable();
            $table->text('header_sub_title_bn')->nullable();
            $table->string('body_title_en');
            $table->string('body_title_bn');
            $table->text('body_sub_title_en')->nullable();
            $table->text('body_sub_title_bn')->nullable();
            $table->string('button_title_en');
            $table->string('button_title_bn');
            $table->string('component_for');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('my_bl_digital_services');
    }
}
