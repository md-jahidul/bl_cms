<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicUrlRedirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_url_redirections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('redirection_for', 30);
            $table->string('identifier')->nullable();
            $table->string('from_url');
            $table->string('to_url');
            $table->boolean('status')->default(true);
            $table->integer('created_by');

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
        Schema::dropIfExists('dynamic_url_redirections');
    }
}
