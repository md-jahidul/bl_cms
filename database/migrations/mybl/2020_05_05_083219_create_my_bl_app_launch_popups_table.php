<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMyBlAppLaunchPopupsTable
 */

/**
 * Class CreateMyBlAppLaunchPopupsTable
 */
class CreateMyBlAppLaunchPopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_app_launch_popups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('image')->comment('image/html');
            $table->string('title')->unique();
            $table->dateTime('start_date')->index();
            $table->dateTime('end_date')->index();
            $table->longText('content');
            $table->json('other_info')->nullable();
            $table->bigInteger('created_by');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('my_bl_app_launch_popups');
    }
}
