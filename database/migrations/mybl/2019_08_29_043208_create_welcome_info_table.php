<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomeInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guest_salutation')->nullable();
            $table->string('user_salutation')->nullable();
            $table->text('guest_message')->nullable();
            $table->text('user_message')->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('welcome_info');
    }
}
