<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessComponentPackageTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_component_package_two', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('title', 50)->nullable();
            $table->string('package_name', 50)->nullable();
            $table->string('data_limit', 50)->nullable();
            $table->string('package_days', 50)->nullable();
            $table->string('price', 100)->nullable();
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
        Schema::dropIfExists('business_component_package_two');
    }
}
