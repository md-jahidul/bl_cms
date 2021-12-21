<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSdVatTaxFieldInAlCoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_core_products', function (Blueprint $table) {
            $table->string('sd_vat_tax_en')->after('short_description')->nullable();
            $table->string('sd_vat_tax_bn')->after('sd_vat_tax_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('al_core_products', function (Blueprint $table) {
            $table->dropColumn('sd_vat_tax_en');
            $table->dropColumn('sd_vat_tax_bn');
        });
    }
}
