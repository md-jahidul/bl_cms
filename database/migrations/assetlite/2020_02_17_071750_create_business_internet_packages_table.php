<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInternetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_internet_packages', function (Blueprint $table) {
             $table->increments('id');
            $table->string('type', 30)->nullable();
            $table->string('content', 30)->nullable();
            $table->string('product_family', 30)->nullable();
            $table->string('product_code', 50)->nullable();
            $table->string('product_code_ev', 50)->nullable();
            $table->string('product_code_with_renew', 50)->nullable();
            $table->string('product_name', 50)->nullable();
            $table->string('product_commercial_name_en', 100)->nullable();
            $table->string('product_commercial_name_bn', 100)->nullable();
            $table->string('product_short_description', 250)->nullable();
            $table->string('activation_ussd_code', 50)->nullable();
            $table->string('balance_check_ussd_code', 50)->nullable();
            $table->string('offer_id', 30)->nullable();
            $table->string('sms_volume', 30)->nullable();
            $table->string('minutes_volume', 30)->nullable();
            $table->string('data_volume', 30)->nullable();
            $table->string('volume_data_unit', 30)->nullable();
            $table->string('validity', 30)->nullable();
            $table->string('validity_unit', 30)->nullable();
            $table->decimal('mrp', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('Tax', 8, 2)->nullable();            
            $table->string('is_amar_offer', 30)->nullable();            
            $table->tinyInteger('is_auto_renewable')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('is_recharge_offer')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('is_gift_offer')->default(0)->comment('1=yes,0=no');
            $table->string('rate_cutter_offer_rate', 50)->nullable(); 
            $table->string('rate_cutter_offer_unit', 50)->nullable(); 
            $table->string('offer_type', 50)->nullable(); 
            $table->string('short_text', 250)->nullable(); 
            $table->string('sms_rate_unit', 30)->nullable(); 
            $table->tinyInteger('home_show')->default(0)->comment('1=show,0=hide');
            $table->tinyInteger('sort')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=show,0=hide');
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
        Schema::dropIfExists('business_internet_packages');
    }
}
