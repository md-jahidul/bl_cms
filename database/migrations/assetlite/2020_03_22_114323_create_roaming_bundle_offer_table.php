<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingBundleOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roaming_bundle_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code', 200);
            $table->mediumInteger('operator_id');
            $table->string('package_name_en', 300)->nullable();
            $table->string('package_name_bn', 300)->nullable();
            $table->string('data_volume', 30)->nullable();
            $table->string('volume_data_unit', 30)->nullable();
            $table->string('validity', 30)->nullable();
            $table->string('validity_unit', 30)->nullable();
            $table->decimal('mrp', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
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
        Schema::dropIfExists('roaming_bundle_offer');
    }
}
