<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCoreHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_core_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code')->unique();
            $table->string('recharge_product_code')->nullable();
            $table->string('renew_product_code')->nullable();
            $table->string('name')->nullable();
            $table->string('commercial_name_en')->nullable();
            $table->string('commercial_name_bn')->nullable();
            $table->text('short_description')->nullable();
            $table->tinyInteger('sim_type')->comment('Prepaid = 1,Postpaid = 2,Propaid = 3');
            $table->string('content_type')->nullable();
            $table->string('family_name')->nullable();
            $table->string('activation_ussd')->nullable();
            $table->string('balance_check_ussd')->nullable();
            $table->double('mrp_price', 10, 2)->nullable();
            $table->double('price', 10, 2)->nullable();
            $table->double('vat', 10, 2)->nullable();
            $table->integer('validity')->nullable();
            $table->string('validity_unit')->nullable();
            $table->double('data_volume', 10, 2)->nullable();
            $table->string('data_volume_unit')->nullable();
            $table->integer('validity_in_days')->nullable();
            $table->integer('internet_volume_mb')->nullable();
            $table->integer('sms_volume')->nullable();
            $table->integer('minute_volume')->nullable();
            $table->float('call_rate')->nullable()->comment('Paisa per second');
            $table->string('call_rate_unit')->nullable();
            $table->float('sms_rate')->nullable()->comment('Paisa per sms');
            $table->tinyInteger('is_auto_renewable')->nullable();
            $table->tinyInteger('is_recharge_offer')->default(0);
            $table->tinyInteger('is_gift_offer')->default(false);
            $table->tinyInteger('show_in_app')->nullable();
            $table->string('offer_id')->nullable();
            $table->json('other_info')->nullable();
            $table->string('platform')->nullable();
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
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
        Schema::dropIfExists('product_core_histories');
    }
}
