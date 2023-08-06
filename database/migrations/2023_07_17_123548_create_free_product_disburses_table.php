<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeProductDisbursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_product_disburses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_id')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('product_code')->nullable();
            $table->boolean('is_disburse')->default(0);
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
        Schema::dropIfExists('free_product_disburses');
    }
}
