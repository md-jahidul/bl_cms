<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDeepLinkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_deep_link_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_code_id')->nullable(false);
            $table->string('msisdn')->nullable();
            $table->string('action_type')->nullable();
            $table->string('action_status')->nullable();
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
        Schema::dropIfExists('product_deep_link_details');
    }
}
