<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('address')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('package')->nullable();
            $table->string('request_type')->nullable();
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
        Schema::dropIfExists('lead_requests');
    }
}
