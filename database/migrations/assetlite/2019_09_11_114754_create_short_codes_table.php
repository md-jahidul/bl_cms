<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
			$table->string('short_code');
			$table->string('copmponent_name');
			$table->string('table_name');
			$table->integer('filter_column');
            $table->integer('filter_value');
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
        Schema::dropIfExists('short_codes');
    }
}

