<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_service_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_service_tab_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('alias');
            $table->tinyInteger('status')->default(1);
            $table->json('other_attributes')->nullable();
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
        Schema::dropIfExists('app_service_categories');
    }
}
