<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSomeColumnInAmarOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amar_offers', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
            $table->renameColumn('offer_code', 'product_code');
            $table->renameColumn('points', 'validity_unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amar_offers', function (Blueprint $table) {
            //
        });
    }
}
