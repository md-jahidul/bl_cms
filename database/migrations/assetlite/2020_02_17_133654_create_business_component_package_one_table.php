<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessComponentPackageOneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_component_package_one', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('table_head', 100)->nullable();
            $table->text('feature_text', 250)->nullable();
            $table->string('price', 100)->nullable();
            $table->tinyInteger('position');
            $table->mediumInteger('service_id')->comment('business other service id');
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
        Schema::dropIfExists('business_component_package_one');
    }
}
