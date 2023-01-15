<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FbRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('thana', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('al_phone', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('purpose', 100)->nullable();
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
        //
        Schema::dropIfExists('fb_registrations');
    }
}
