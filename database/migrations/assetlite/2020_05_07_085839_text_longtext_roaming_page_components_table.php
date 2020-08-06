<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TextLongtextRoamingPageComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_page_components', function (Blueprint $table) {
            $table->longText('body_text_en')->change();
            $table->longText('body_text_bn')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roaming_page_components', function (Blueprint $table) {
            $table->longText('body_text_en')->change();
            $table->longText('body_text_bn')->change();
        });
    }
}
