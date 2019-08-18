<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('campaign_id')->unsigned();
            $table->foreign('campaign_id')
                    ->references('id')
                    ->on('campaigns')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->integer('product_id');

            $table->string('title');
            $table->string('position');
            $table->string('reword');
            $table->string('validity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
}
