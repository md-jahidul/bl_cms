<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('my_bl_service_items');

        Schema::create('my_bl_service_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('my_bl_service_id');
            $table->foreign('my_bl_service_id')->references('id')->on('my_bl_services')->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('image_url')->nullable();
            $table->string('alt_text')->nullable();
            $table->integer('sequence');
            $table->boolean('status')->default(false);
            $table->string('deeplink')->nullable();
            $table->string('component_identifier')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('is_highlight')->default(false);
            $table->bigInteger('android_version_code_min')->default(0);
            $table->bigInteger('android_version_code_max')->default(999999999);
            $table->bigInteger('ios_version_code_min')->default(0);
            $table->bigInteger('ios_version_code_max')->default(999999999);
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
        Schema::dropIfExists('my_bl_service_items');
    }
}
