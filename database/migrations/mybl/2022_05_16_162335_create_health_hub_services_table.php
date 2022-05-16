<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHubServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_hub_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('logo');
            $table->string('details_en');
            $table->string('details_bn');
            $table->boolean('status');
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
        Schema::dropIfExists('health_hub_services');
    }
}
