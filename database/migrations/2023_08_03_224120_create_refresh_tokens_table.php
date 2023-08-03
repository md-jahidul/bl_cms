<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRefreshTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refresh_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->nullable();
            $table->string('msisdn')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->uuid('uid')->nullable();
            $table->timestamps();
            $table->foreign('uid')->references('uid')->on('guest_customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refresh_tokens', function (Blueprint $table) {
            //
        });
    }
}
