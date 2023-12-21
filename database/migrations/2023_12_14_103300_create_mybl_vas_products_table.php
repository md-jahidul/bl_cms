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
            $table->string('cp_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('desc_en')->nullable();
            $table->string('desc_bn')->nullable();
            $table->double('price', 8, 2);
            $table->string('validity_en')->nullable();
            $table->string('validity_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('platform')->nullable();
            $table->boolean('is_renewal')->default(0);
            $table->boolean('status')->default(0);
            $table->string('activation_type')->default('Default');
            $table->string('deactivation_type')->default('Default');
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
