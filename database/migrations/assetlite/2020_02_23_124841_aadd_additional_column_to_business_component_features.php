<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_component_features', function (Blueprint $table) {
             $table->text('feature_text_bn')->nullable()->after('feature_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_component_features', function (Blueprint $table) {
            //
        });
    }
}
