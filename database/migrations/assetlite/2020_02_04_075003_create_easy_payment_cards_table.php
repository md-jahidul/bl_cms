<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEasyPaymentCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('easy_payment_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 30)->nullable();
            $table->string('division', 30)->nullable();
            $table->string('area', 40)->nullable();
            $table->string('branch_name', 60)->nullable();
            $table->string('address', 250)->nullable();
            $table->tinyInteger('status')->comment('1=Show,0=Hide');
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
        Schema::dropIfExists('easy_payment_cards');
    }
}
