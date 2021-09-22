<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchAccountRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switch_account_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id');
            $table->string('from_msisdn', 20);
            $table->string('to_msisdn', 20);
            $table->tinyInteger('status')->default(2);

            $table->index('notification_id');
            $table->index('from_msisdn');
            $table->index('to_msisdn');

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
        Schema::dropIfExists('switch_account_requests');
    }
}
