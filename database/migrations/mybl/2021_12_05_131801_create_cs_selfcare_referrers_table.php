<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsSelfcareReferrersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_selfcare_referrers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referrer')->unique();
            $table->string('referral_code',10)->index();
            $table->boolean('is_active')->default(1)->index();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
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
        Schema::dropIfExists('cs_selfcare_referrers');
    }
}
