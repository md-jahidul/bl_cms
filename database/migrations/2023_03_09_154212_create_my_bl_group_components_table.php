<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlGroupComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_group_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_1_id')->nullable();
            $table->string('member_1_type')->nullable();
            $table->string('member_2_id')->nullable();
            $table->string('member_2_type')->nullable();
            $table->string('component_for');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->integer('display_order')->nullable();
            $table->boolean('is_api_call_enable')->nullable();
            $table->boolean('is_eligible')->default(false);
            $table->boolean('is_fixed_position')->default(false);
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->boolean('active')->default(true);
            $table->string('icon')->nullable();
            $table->boolean('is_title_show')->default(0);
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
        Schema::dropIfExists('my_bl_group_components');
    }
}
