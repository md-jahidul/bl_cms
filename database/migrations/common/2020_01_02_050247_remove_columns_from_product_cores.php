<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsFromProductCores extends Migration
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
                'is_bundle',
                'purchase_option',
                'show_in_app',
                'is_amar_offer',
                'is_social_pack',
                'is_rate_cutter_offer',
                'segment',
                'assetlite_offer_type',
                'app_offer_section'
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
            $table->boolean('is_bundle')->nullable();
            $table->string('purchase_option')->nullable();
            $table->boolean('show_in_app')->nullable();
            $table->boolean('is_amar_offer')->nullable();
            $table->boolean('is_social_pack')->nullable();
            $table->boolean('is_rate_cutter_offer')->nullable();
            $table->string('segment')->nullable();
            $table->string('assetlite_offer_type')->nullable();
            $table->string('app_offer_section')->nullable();
        });
    }
}
