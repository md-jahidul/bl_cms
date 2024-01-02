<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblAppRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_app_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn', 13);
            $table->string('platform', 10);
            $table->bigInteger('version_code');
            $table->double('rating');
            $table->string('message')->nullable();
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
        Schema::dropIfExists('mybl_app_ratings');
    }
}
