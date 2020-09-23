<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeAPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('be_a_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_bn')->nullable();
            $table->string('vendor_button_en')->nullable();
            $table->string('vendor_button_bn')->nullable();
            $table->string('vendor_portal_url')->nullable();
            $table->string('interested_button_en')->nullable();
            $table->string('interested_button_bn')->nullable();
            $table->string('interested_url')->nullable();
            $table->json('banner_image');
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
        Schema::dropIfExists('be_a_partners');
    }
}
