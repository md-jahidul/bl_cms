<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHubSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_hub_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn');
            $table->unsignedBigInteger('package_id');
            $table->boolean('active');
            $table->string('starts_at', 0);
            $table->string('expires_at', 0);
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
        Schema::dropIfExists('health_hub_subscriptions');
    }
}
