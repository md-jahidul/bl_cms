<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblHomeComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_home_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('component_key')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->boolean('is_api_call_enable')->nullable();
            $table->boolean('is_eligible')->nullable();
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
        Schema::dropIfExists('mybl_home_components');
    }
}
