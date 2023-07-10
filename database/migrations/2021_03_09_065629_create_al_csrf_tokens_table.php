<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlCsrfTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_csrf_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->index()->nullable();
            $table->string('secret_key')->index()->nullable();
            $table->dateTime('expires_at')->index()->nullable();
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
        Schema::dropIfExists('al_csrf_tokens');
    }
}
