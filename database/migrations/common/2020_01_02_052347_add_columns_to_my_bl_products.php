<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMyBlProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_products', function (Blueprint $table) {
            $table->boolean('is_gift_offer')->after('tag') ->default(0);
            $table->boolean('is_social_pack')->after('tag')->default(0);
            $table->boolean('is_rate_cutter_offer')->after('tag')->default(0);
            $table->boolean('is_amar_offer')->after('tag')->default(0);
            $table->string('offer_section_title')->nullable()->after('tag');
            $table->string('offer_section_slug')->nullable()->after('tag');
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
            $table->dropColumn([
                'is_gift_offer',
                'is_social_pack',
                'is_amar_offer',
                'is_rate_cutter_offer',
                'offer_section_title',
                'offer_section_slug'
            ]);
        });
    }
}
