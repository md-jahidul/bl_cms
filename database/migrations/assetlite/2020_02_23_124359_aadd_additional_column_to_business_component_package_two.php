<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentPackageTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_component_package_two', function (Blueprint $table) {
            $table->string('title_bn', 100)->nullable()->after('title');
            $table->string('package_name_bn', 100)->nullable()->after('package_name');
            $table->string('data_limit_bn', 100)->nullable()->after('data_limit');
            $table->string('package_days_bn', 100)->nullable()->after('package_days');
            $table->string('price_bn', 150)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_component_package_two', function (Blueprint $table) {
            //
        });
    }
}
