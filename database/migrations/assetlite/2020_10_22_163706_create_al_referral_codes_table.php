<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlReferralCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_referral_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_id')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('referral_code')->nullable();
            $table->integer('share_count')->default(0);
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
        Schema::dropIfExists('al_referral_codes');
    }
}
