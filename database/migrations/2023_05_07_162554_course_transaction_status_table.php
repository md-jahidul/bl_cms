<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseTransactionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_transaction_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id')->unique();
            $table->string('contact_no')->index();
            $table->float('sub_total',8,2);
            $table->string('promo_code')->nullable();
            $table->string('total_promo_discount')->nullable();
            $table->string('total_default_discount')->nullable();
            $table->float('order_total_price',8,2);
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
        Schema::dropIfExists('course_transaction_status');
    }
}
