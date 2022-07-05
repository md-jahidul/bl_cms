<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPackPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pack_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('msisdn')->index();
            $table->string('product_code')->nullable(false)->index();
            $table->integer('purchase_count')->default(1);

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
        Schema::dropIfExists('user_pack_purchases');
    }
}
