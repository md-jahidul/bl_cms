<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushNotificationProductPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notification_product_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('notification_id');
            $table->string('notification_title');
            $table->string('product_code')->nullable(true);
            $table->integer('total_buy')->default(0);
            $table->integer('total_cancel')->default(0);
            $table->integer('total_buy_attempt')->default(0);
            $table->integer('is_delete')->default(0);
            $table->index('notification_id');
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
        Schema::dropIfExists('push_notification_product_purchases');
    }
}
