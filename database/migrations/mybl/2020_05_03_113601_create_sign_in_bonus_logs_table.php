<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSignInBonusLogsTable
 */
class CreateSignInBonusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_in_bonus_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn');
            $table->date('date');
            $table->string('status')->default('000');
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
        Schema::dropIfExists('sign_in_bonus_logs');
    }
}
