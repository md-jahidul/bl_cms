<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMyBlLearnPriyojonContentsTable
 */
class CreateMyBlLearnPriyojonContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_learn_priyojon_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform')->default('app');
            $table->longText('contents');
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
        Schema::dropIfExists('my_bl_learn_priyojon_contents');
    }
}
