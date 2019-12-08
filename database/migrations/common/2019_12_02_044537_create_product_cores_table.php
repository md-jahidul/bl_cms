<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->string('commercial_name_en')->nullable();
            $table->string('commercial_name_bn')->nullable();
            $table->text('short_description')->nullable();
            $table->tinyInteger('sim_type')->comment('prepaid = 1,postpaid = 2,propaid = 3');
            $table->string('content_type')->nullable();
            $table->string('family_name')->nullable();
            $table->string('activation_ussd')->nullable();
            $table->string('balance_check_ussd')->nullable();
            $table->double('mrp_price', 10, 2)->nullable();
            $table->double('price', 10, 2)->nullable();
            $table->double('vat', 10, 2)->nullable();
            $table->integer('validity')->nullable();
            $table->string('validity_unit')->nullable();
            $table->integer('internet_volume_mb')->nullable();
            $table->string('data_volume_unit')->nullable();
            $table->integer('sms_volume')->nullable();
            $table->integer('minute_volume')->nullable();
            $table->integer('call_rate')->nullable()->comment('Paisa per second');
            $table->integer('sms_rate')->nullable()->comment('Paisa per sms');

            $table->tinyInteger('is_bundle')->nullable();
            $table->tinyInteger('is_auto_renewable')->nullable();
            $table->tinyInteger('is_recharge_offer')->nullable();
            $table->tinyInteger('is_gift_offer')->default(false);
            $table->tinyInteger('show_in_app')->nullable();
            $table->string('offer_id')->nullable();
            $table->tinyInteger('is_amar_offer')->nullable();
            $table->json('other_info')->nullable();
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
            $table->string('segment')->nullable()->comment('both = 1, b2b = 2, b2c = 3');
            $table->timestamps();

            $table->index(['code', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cores');
    }
}
