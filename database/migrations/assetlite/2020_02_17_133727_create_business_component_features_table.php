<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessComponentFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_component_features', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->text('feature_text')->nullable();
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
        Schema::dropIfExists('business_component_features');
    }
}
