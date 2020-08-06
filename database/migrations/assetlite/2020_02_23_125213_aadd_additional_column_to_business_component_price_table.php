<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_component_price_table', function (Blueprint $table) {
            $table->string('title_bn', 250)->nullable()->after('title');
            $table->text('table_head_bn')->nullable()->after('table_head');
            $table->text('table_body_bn')->nullable()->after('table_body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_component_price_table', function (Blueprint $table) {
            //
        });
    }
}
