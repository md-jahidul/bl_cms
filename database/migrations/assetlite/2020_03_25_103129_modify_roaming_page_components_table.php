<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRoamingPageComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_page_components', function (Blueprint $table) {
             $table->dropColumn(['big_font', 'payment_block']);
             $table->string('headline_en', 300)->nullable()->after("parent_id");
             $table->string('headline_bn', 300)->nullable()->after("parent_id");
             $table->tinyInteger('show_button')->nullable()->after("parent_id");
             $table->string('component_type', 100)->comment("headline-text, list-component, free-text")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
