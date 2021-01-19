<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerAnalyticDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_analytic_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('banner_analytic_id');
            $table->string('msisdn', 20);
            $table->string('action_type', 50);
            $table->integer('session_time')->nullable();
            $table->string('error_title')->nullable();

            $table->timestamps();

            $table->index('banner_analytic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_analytic_details');
    }
}
