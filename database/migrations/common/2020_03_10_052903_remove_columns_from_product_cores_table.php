<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class RemoveColumnsFromProductCoresTable
 */
class RemoveColumnsFromProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->dropColumn([
                'family_name',
                'is_auto_renewable',
                'is_recharge_offer',
                'is_gift_offer',
                'offer_id'

            ]);
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
            $table->tinyInteger('is_auto_renewable')->nullable();
            $table->tinyInteger('is_recharge_offer')->nullable();
            $table->tinyInteger('is_gift_offer')->default(false);
            $table->string('offer_id')->nullable();
            $table->string('family_name')->nullable();
        });
    }
}
