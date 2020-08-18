<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNameAppServiceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->renameColumn('ussd_Bn', 'ussd_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->renameColumn('ussd_bn', 'ussd_Bn');
        });
    }
}
