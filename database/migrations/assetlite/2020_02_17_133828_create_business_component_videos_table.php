<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessComponentVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_component_videos', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100)->nullable();
            $table->string('title', 250)->nullable();
            $table->text('description')->nullable();
            $table->text('embed_code')->nullable();
            $table->tinyInteger('position');
            $table->mediumInteger('service_id')->comment('business other service id');
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
        Schema::dropIfExists('business_component_videos');
    }
}
