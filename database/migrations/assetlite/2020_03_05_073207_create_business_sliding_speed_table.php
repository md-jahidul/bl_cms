<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessSlidingSpeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_sliding_speed', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->tinyInteger('enterprise_speed')->default(1)->comment("in seconds");
            $table->tinyInteger('news_speed')->default(1)->comment("in seconds");
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
        Schema::dropIfExists('business_sliding_speed');
    }
}
