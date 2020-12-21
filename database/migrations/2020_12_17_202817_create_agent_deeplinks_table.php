<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentDeeplinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_deeplinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('agent_id')->unsigned();
            $table->string('deeplink_type',80)->nullable(false);
            $table->string('product_code',80)->nullable(false);
            $table->string('deep_link',255)->nullable(false);
            $table->integer('total_view')->nullable(false)->default(0);
            $table->integer('total_buy')->nullable(false)->default(0);
            $table->integer('total_cancel')->nullable(false)->default(0);
            $table->integer('buy_attempt')->nullable(false)->default(0);
            $table->foreign('agent_id')->references('id')->on('agent_lists')->onDelete('cascade');
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
        Schema::table('agent_deeplinks', function (Blueprint $table) {
            $table->dropForeign('agent_deeplinks_agent_id_foreign');
        });
        Schema::dropIfExists('agent_deeplinks');
    }
}
