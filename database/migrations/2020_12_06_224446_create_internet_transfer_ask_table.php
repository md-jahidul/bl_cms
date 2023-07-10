<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternetTransferAskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_transfer_asks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('notification_id')->nullable(false);
            $table->string('request_from')->nullable(false);
            $table->string('request_to')->nullable(false);
            $table->string('product_code')->nullable(false);
            $table->string('status')->default(2)->nullable()->comment('2 = ask alert in app , 1 = approved,0=cancel');
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
        Schema::dropIfExists('internet_transfer_ask');
    }
}
