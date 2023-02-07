<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHibernateCustomerMsisdnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hibernate_customer_msisdns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn')->index();
            $table->boolean('is_eligible')->default(1);
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hibernate_customer_msisdns');
    }
}
