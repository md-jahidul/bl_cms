<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->dateTime('start_time');
            $table->integer('ticketing_time');
            $table->string('signed_cookie')->nullable();
            $table->string('url');
            $table->boolean('status')->default(0);
            $table->boolean('is_hidden')->default(0);
            $table->integer('number_of_seats')->default(20000);
            $table->timestamps();
            $table->foreign('home_team_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('away_team_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
