<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblDeeplinkMsisdnCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_deeplink_msisdn_counts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dynamic_deeplink_id');
            $table->integer('msisdn')->nullable();
            $table->timestamps();
            $table->foreign('dynamic_deeplink_id')
                ->references('id')
                ->on('mybl_dynamic_deeplinks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mybl_deeplink_msisdn_counts');
    }
}
