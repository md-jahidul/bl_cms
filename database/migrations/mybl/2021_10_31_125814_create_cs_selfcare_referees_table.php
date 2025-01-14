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
            $table->unsignedSmallInteger('cs_selfcare_referrer_id');
            $table->string('referee_msisdn')->nullable()->index();
            $table->boolean('is_redeemed')->default(0)->index();
            $table->dateTime('redeemed_at')->nullable();
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
