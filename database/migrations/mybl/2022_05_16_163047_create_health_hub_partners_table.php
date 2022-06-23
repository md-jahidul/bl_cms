<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHubPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_hub_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partner_id');
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('access_key')->nullable();
            $table->string('logo');
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
        Schema::dropIfExists('health_hub_partners');
    }
}
