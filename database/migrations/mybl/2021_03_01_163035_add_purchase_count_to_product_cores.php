<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurchaseCountToProductCores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('product_cores','purchase_count')) {
            Schema::table('product_cores', function (Blueprint $table) {
                $table->integer('purchase_count')->nullable(false)->default(0);
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('product_cores', 'purchase_count')) {
            Schema::table('product_cores', function (Blueprint $table) {
                $table->dropColumn('purchase_count');
            });
        }

    }
}
