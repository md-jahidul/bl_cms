<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidityInDaysToProductCores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->integer('validity_in_days')->after('validity_unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->dropColumn('validity_in_days');
        });
    }
}
