<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlCoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_core_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code');
            $table->string('renew_product_code')->nullable();
            $table->string('recharge_product_code')->nullable();
            $table->string('name')->nullable();
            $table->string('commercial_name_en')->nullable();
            $table->string('commercial_name_bn')->nullable();
            $table->text('short_description')->nullable();
            $table->tinyInteger('sim_type')->comment('Prepaid = 1,Postpaid = 2,Propaid = 3');
            $table->string('content_type')->nullable();
            $table->string('activation_ussd')->nullable();
            $table->string('balance_check_ussd')->nullable();
            $table->double('mrp_price', 10, 2)->nullable();
            $table->double('price', 10, 2)->nullable();
            $table->double('vat', 10, 2)->nullable();
            $table->integer('validity')->nullable();
            $table->string('validity_unit')->nullable();
            $table->integer('validity_in_days')->nullable();
            $table->string('data_volume_unit')->nullable();
            $table->double('data_volume', 10, 2)->nullable();
            $table->integer('internet_volume_mb')->nullable();
            $table->integer('sms_volume')->nullable();
            $table->integer('minute_volume')->nullable();
            $table->float('call_rate')->nullable()->comment('Paisa per second');
            $table->string('call_rate_unit')->nullable();
            $table->float('sms_rate')->nullable()->comment('Paisa per sms');
            $table->float('sms_rate_unit')->nullable();
            $table->json('other_info')->nullable();
            $table->string('platform')->nullable();
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
            $table->timestamps();

            $table->index('product_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('al_core_products');
    }
}
