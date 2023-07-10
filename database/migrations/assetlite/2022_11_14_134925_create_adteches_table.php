<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdtechesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_teches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_type')->nullable();
            $table->integer('reference_id')->nullable();
            $table->string('img_url')->nullable();
            $table->string('img_name_en')->nullable();
            $table->string('img_name_bn')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('redirect_url_en')->nullable();
            $table->string('redirect_url_bn')->nullable();
            $table->tinyInteger('is_external_url')->default(0);
            $table->string('external_url')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('adteches');
    }
}
