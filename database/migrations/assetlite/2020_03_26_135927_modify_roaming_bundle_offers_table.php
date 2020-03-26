<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRoamingBundleOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('roaming_bundle_offers', function (Blueprint $table) {
             $table->string('mrp', 40)->nullable()->change();
             $table->string('price', 40)->nullable()->change();
             $table->string('tax', 40)->nullable()->change();
             $table->text('details_bn')->nullable()->after('tax');
             $table->text('details_en')->nullable()->after('tax');
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
