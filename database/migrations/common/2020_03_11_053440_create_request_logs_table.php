<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRequestLogsTable
 */
class CreateRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->string('request_method');
            $table->text('request_header')->nullable();
            $table->text('request_body')->nullable();
            $table->string('ip');
            $table->decimal('start_time', 25, 2);
            $table->decimal('end_time', 25, 2);
            $table->decimal('response_time', 25, 2);
            $table->string('status_code');
            $table->longText('response_body')->nullable();
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
        Schema::dropIfExists('request_logs');
    }
}
