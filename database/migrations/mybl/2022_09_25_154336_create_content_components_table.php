<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('component_key')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->integer('display_order')->nullable();
            $table->boolean('is_api_call_enable')->nullable();
            $table->boolean('is_eligible')->nullable();
            $table->boolean('is_fixed_position')->default(false);
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
        Schema::dropIfExists('content_components');
    }
}
