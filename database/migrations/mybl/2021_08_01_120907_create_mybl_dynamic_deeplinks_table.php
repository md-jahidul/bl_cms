<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblDynamicDeeplinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_dynamic_deeplinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('referenceable_id')->nullable();
            $table->string('referenceable_type')->nullable();
            $table->string('link')->nullable();
            $table->string('deep_link')->nullable();
            $table->integer('clicked_android')->default(0);
            $table->integer('clicked_ios')->default(0);
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
        Schema::dropIfExists('mybl_dynamic_deeplinks');
    }
}
