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
            $table->unsignedBigInteger('health_hub_dashboard_id')->nullable();
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('logo');
            $table->text('details_en');
            $table->text('details_bn');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('health_hub_dashboard_id')
            ->references('id')
            ->on('health_hub_dashboards');
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
