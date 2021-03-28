<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextualCardLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contextual_card_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contextual_card_id');
            $table->string('msisdn' ,20);
            $table->integer('is_read')->default(0);
            $table->integer('is_delete')->default(0);
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
        Schema::dropIfExists('contextual_card_logs');
    }
}
