<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentDeeplinkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_deeplink_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('agent_deeplink_id')->unsigned();
            $table->string('msisdn')->nullable();
            $table->string('action_type')->nullable();
            $table->string('action_status')->nullable();
            $table->foreign('agent_deeplink_id')->references('id')->on('agent_deeplinks')->onDelete('cascade');
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
        Schema::table('agent_deeplink_details', function (Blueprint $table) {
            $table->dropForeign('agent_deeplink_details_agent_deeplink_id_foreign');
        });
        Schema::dropIfExists('agent_deeplink_details');
    }
}
