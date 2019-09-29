<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('page_id');
            $table->string('component_type');                        // such as slider,recharge
            $table->unsignedInteger('component_id')->nullable();     // such as slider_id 
            $table->string('component_status')->default('enabled');        
            $table->string('display_order')->default(0);
            $table->string('is_active')->default(1);
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
        Schema::dropIfExists('short_codes');
    }
}
