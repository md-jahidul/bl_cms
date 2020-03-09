<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSectionTyleAppServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_product_details', function (Blueprint $table) {
            $table->text('section_type')->nullable()->after('tab_type')->comment('Several type of section related to ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_product_details', function (Blueprint $table) {
            $table->dropColumn('section_type');
        });
    }
}
