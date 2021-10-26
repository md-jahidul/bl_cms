<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsSelfcareRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_selfcare_referees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn')->index();
            $table->string('referral_code', 10);
            $table->boolean('is_redeemed')->default(0)->index();
            $table->dateTime('redeemed_at')->nullable();
            $table->boolean('status')->default(1)->index();
            $table->dateTime('expired_at')->nullable();
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
        Schema::dropIfExists('cs_selfcare_referees');
    }
}
