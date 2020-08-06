<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAssignedFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_assigned_features', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('feature_id');
            $table->tinyInteger('parent_type')->default(0)->comment("1=package,2=business solution,3=IOT,4=Others");
            $table->mediumInteger('parent_id')->default(0)->comment('business product id');
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
        Schema::dropIfExists('business_assigned_features');
    }
}
