<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePgwGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pgw_gateways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gateway_id')->nullable();
            $table->string('gateway_name', 100)->nullable();
            $table->boolean('status')->default(false);
            $table->string('currency', 10)->nullable();
            $table->string('logo_web', 100)->nullable();
            $table->string('logo_mobile', 100)->nullable();
            $table->string('type', 100)->nullable();
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
        Schema::dropIfExists('pgw_gateways');
    }
}
