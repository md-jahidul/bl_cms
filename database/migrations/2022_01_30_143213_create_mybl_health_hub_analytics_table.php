<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblHealthHubAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_health_hub_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('health_hub_id');
            $table->integer('hit_count')->nullable();
            $table->integer('deeplink_hit_count')->default(0);
            $table->bigInteger('total_session_time')->nullable()->default(0);
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
        Schema::dropIfExists('mybl_health_hub_analytics');
    }
}
