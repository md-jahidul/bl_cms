<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRoamingGeneralPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_general_pages', function (Blueprint $table) {
             $table->dropColumn(['short_text_en', 'short_text_bn', 'sub_headline_en', 'sub_headline_bn', 'body_text_en', 'body_text_bn']);
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
