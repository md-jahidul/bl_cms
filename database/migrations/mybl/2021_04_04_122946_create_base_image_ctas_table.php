<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseImageCtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_image_ctas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_id')->unsigned()->nullable(false);
            $table->bigInteger('banner_id')->nullable(false);
            $table->string('action_name' ,255)->nullable(false);
            $table->string('action_url_or_code' ,255)->nullable(true);
            $table->foreign('group_id')->references('id')->on('base_msisdn_groups');
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
        Schema::dropIfExists('base_image_ctas');
    }
}
