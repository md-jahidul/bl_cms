<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoImageFiledsInCorpInitiativeTabComponents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corp_initiative_tab_components', function (Blueprint $table) {
            $table->string('single_base_image')->nullable();
            $table->string('single_alt_text_en')->nullable();
            $table->string('single_alt_text_bn')->nullable();
            $table->string('single_image_name_en')->nullable();
            $table->string('single_image_name_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corp_initiative_tab_components', function (Blueprint $table) {
            $table->dropColumn('base_image');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('image_name_en');
            $table->dropColumn('image_name_bn');
        });
    }
}
