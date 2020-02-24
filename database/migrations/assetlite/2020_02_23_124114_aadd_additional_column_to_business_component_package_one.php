<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentPackageOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_component_package_one', function (Blueprint $table) {
            $table->string('table_head_bn', 100)->nullable()->after('table_head');
            $table->text('feature_text_bn')->nullable()->after('feature_text');
            $table->string('price_bn', 100)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_component_package_one', function (Blueprint $table) {
            //
        });
    }
}
