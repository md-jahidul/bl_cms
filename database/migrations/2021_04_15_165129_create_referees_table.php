<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('referrer_id')->index('referees_referrer_id_index');
            $table->string('referee_msisdn')->index('referees_referee_msisdn_index');
            $table->boolean('is_invited')->default(false);
            $table->boolean('is_reminded')->default(false);
            $table->dateTime('remind_after')->nullable();
            $table->boolean('is_new')->default(false);
            $table->string('status', 20);
            $table->dateTime('redeem_at')->nullable();
            $table->dateTime('claimed_at')->nullable();

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
        Schema::dropIfExists('referees');
    }
}
