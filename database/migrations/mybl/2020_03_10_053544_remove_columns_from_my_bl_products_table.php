<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnsFromMyBlProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->dropColumn([
                'is_amar_offer',
                'is_social_pack',
                'is_gift_offer'
            ]);

            $table->tinyInteger('show_recharge_offer')->after('offer_section_title')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->boolean('is_gift_offer')->after('tag') ->default(0);
            $table->boolean('is_social_pack')->after('tag')->default(0);
            $table->boolean('is_amar_offer')->after('tag')->default(0);

            $table->dropColumn('show_recharge_offer');
        });
    }
}
