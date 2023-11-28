<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToffeeSubscriptionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toffee_subscription_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subscription_type')->unique();
            $table->string('content_ids')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('toffee_subscription_types');
    }
}
