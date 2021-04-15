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
            $table->integer('refer_and_earn_id');
            $table->string('referrer_msisdn');
            $table->string('referee_msisdn');
            $table->boolean('is_invited')->default(false);
            $table->boolean('is_reminded')->default(false);
            $table->dateTime('remind_after');
            $table->string('status', 20);

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
