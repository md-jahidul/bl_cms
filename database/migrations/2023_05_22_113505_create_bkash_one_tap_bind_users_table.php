<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkashOneTapBindUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkash_one_tap_bind_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mybl_user_msisdn')->index();
            $table->string('bkash_number');
            $table->string('user_id');
            $table->string('access_token');
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
        Schema::dropIfExists('bkash_one_tap_bind_users');
    }
}
