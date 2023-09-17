<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductCoreChangeStateStatusToMyBlProductSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_product_schedulers', function (Blueprint $table) {
            $table->boolean('product_core_change_state_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_product_schedulers', function (Blueprint $table) {
            $table->dropColumn('product_core_change_state_status');
        });
    }
}
