<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblVasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_vas_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subscription_offer_id');
            $table->string('partner_id')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('desc_bn')->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->string('validity_en')->nullable();
            $table->string('validity_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('platform')->nullable();
            $table->boolean('is_renewable')->default(0);
            $table->integer('display_order')->nullable();
            $table->boolean('status')->default(0);
            $table->string('activation_type')->default('Default');
            $table->string('activation_deeplink')->nullable();
            $table->string('deactivation_type')->default('Default');
            $table->string('deactivation_deeplink')->nullable();
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
        Schema::dropIfExists('mybl_vas_products');
    }
}
