<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnTypeChangeInBeAPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('be_a_partners', function (Blueprint $table) {
            $table->string('banner_image')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('be_a_partners', function (Blueprint $table) {
            $table->json('banner_image')->change();
        });
    }
}
