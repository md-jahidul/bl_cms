<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportMessageRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_message_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn')->nullable(false);
            $table->integer('ticket_id')->nullable(false);
            $table->float('ratings',8,2)->nullable(false);
            $table->string('category_name')->nullable();
            $table->string('complaint_location')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('support_message_ratings');
    }
}
