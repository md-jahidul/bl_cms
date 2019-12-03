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
            $table->string('product_code');
            $table->string('product_name')->nullable();
            $table->text('product_short_dec')->nullable();
            $table->string('ussd_activation_code')->nullable();
            $table->string('ussd_short_dec')->nullable();
            $table->double('product_price', 10, 2)->nullable();
            $table->double('product_total_price', 10, 2)->nullable();
            $table->integer('product_vat')->nullable();

            $table->integer('product_validity')->nullable();
            $table->string('product_validity_unit')->nullable();

            $table->integer('product_content_type')->nullable();
            $table->string('product_family')->nullable();
            $table->integer('product_sms_count')->nullable();
            $table->integer('product_minute')->nullable();
            $table->integer('product_mb')->nullable();

            $table->tinyInteger('is_bundle')->default(0);
            $table->tinyInteger('is_reactivable')->default(0);
            $table->tinyInteger('status')->default(1)->comment('active = 1, inactive = 0');
            $table->integer('product_segment')->default(1)->comment('both = 1, b2b = 2, b2c = 3');
            $table->integer('product_package')->default(1)->comment('prepaid = 1, postpaid = 2, propaid = 3');

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
        Schema::dropIfExists('product_cores');
    }
}
