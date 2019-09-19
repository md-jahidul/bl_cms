<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWellcomeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wellcome_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('guest_salutation');
            $table->text('user_salutation');
            $table->text('guest_message');
            $table->text('user_message');
            $table->text('icon');
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
        Schema::dropIfExists('welcome_infos');
    }
}
