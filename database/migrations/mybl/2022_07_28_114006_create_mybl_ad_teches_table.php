<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblAdTechesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_ad_teches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('image_url');
            $table->string('external_url')->nullable();
            $table->integer('display_order');
            $table->string('user_group_type')->nullable();
            $table->bigInteger('base_groups_id')->nullable();
            $table->boolean('status')->default(0);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
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
        Schema::dropIfExists('mybl_ad_teches');
    }
}
