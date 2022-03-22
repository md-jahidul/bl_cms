<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogModelActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_model_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action');
            $table->bigInteger('user_id')->nullable();
            $table->text('data')->nullable();
            $table->string('model')->nullable();
            $table->timestamp('logged_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_model_actions');
    }
}
