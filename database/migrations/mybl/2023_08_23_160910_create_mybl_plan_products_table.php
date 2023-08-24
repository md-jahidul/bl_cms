<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblPlanProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_plan_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sim_type');
            $table->string('content_type')->nullable();
            $table->string("product_code");
            $table->string("renew_product_code")->nullable();
            $table->string("recharge_product_code")->nullable();
            $table->string("sms_volume")->nullable();
            $table->string("minute_volume")->nullable();
            $table->string("data_volume")->nullable();
            $table->string("data_volume_unit")->nullable();
            $table->string("validity")->nullable();
            $table->string("validity_unit")->nullable();
            $table->string("tag")->nullable();
            $table->string("display_sd_vat_tax_en")->nullable();
            $table->string("display_sd_vat_tax_bn")->nullable();
            $table->string("points")->nullable();
            $table->string("market_price");
            $table->string("discount_price");
            $table->string("discount_percentage");
            $table->string("is_active")->default(1);
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
        Schema::dropIfExists('my_bl_plan_products');
    }
}
