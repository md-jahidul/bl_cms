<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('welcome_message');
            $table->text('welcome_description');
            $table->string('welcome_logo');
            $table->enum('welcome_category', ['home','dashbord','other']);
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
