<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsHomeComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_home_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('component_key');
            $table->string('title_en');
            $table->string('title_bn');
            $table->integer('display_order');
            $table->boolean('is_api_call_enable')->default(1);
            $table->boolean('is_eligible')->default(1);
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
        Schema::dropIfExists('lms_home_components');
    }
}
