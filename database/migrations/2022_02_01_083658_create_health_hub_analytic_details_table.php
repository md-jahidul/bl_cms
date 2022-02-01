<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHubAnalyticDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_hub_analytic_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('health_hub_id');
            $table->unsignedBigInteger('health_hub_analytic_id');
            $table->integer('msisdn')->nullable();
            $table->integer('session_time')->nullable();
            $table->foreign('health_hub_id')
                ->references('id')
                ->on('mybl_health_hubs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('health_hub_analytic_details');
    }
}
