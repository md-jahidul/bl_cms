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
            $table->integer("sms_volume")->nullable();
            $table->integer("minute_volume")->nullable();
            $table->integer("data_volume")->nullable();
            $table->string("data_volume_unit")->nullable();
            $table->integer("validity")->nullable();
            $table->string("validity_unit")->nullable();
            $table->string("tag")->nullable();
            $table->string("display_sd_vat_tax_en")->nullable();
            $table->string("display_sd_vat_tax_bn")->nullable();
            $table->string("points")->nullable();
            $table->integer("market_price");
            $table->integer("discount_price");
            $table->integer("savings_amount");
            $table->integer("discount_percentage");
            $table->tinyInteger("is_active")->default(1);
            $table->tinyInteger("is_default")->default(0);
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
