<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessComponentPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_component_photos', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('photo_one', 250)->nullable();
            $table->string('photo_two', 250)->nullable();
            $table->string('photo_three', 250)->nullable();
            $table->string('photo_four', 250)->nullable();
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
        Schema::dropIfExists('business_component_photos');
    }
}
