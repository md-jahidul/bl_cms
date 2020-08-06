<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->string('name_bn', 250)->nullable()->after('name');
            $table->string('alt_text', 250)->nullable()->after('banner_photo');
            $table->string('short_details_bn', 250)->nullable()->after('short_details');
            $table->text('main_details_bn')->nullable()->after('main_details');
            $table->text('offer_details_bn')->nullable()->after('offer_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            //
        });
    }
}
