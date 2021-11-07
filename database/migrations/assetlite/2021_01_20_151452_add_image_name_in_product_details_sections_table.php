<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInProductDetailsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('product_details_sections', 'banner_name_bn')) {
                $table->string('banner_name_bn')->after('banner_name')->nullable();
                $table->string('alt_text_bn')->after('alt_text')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details_sections', function (Blueprint $table) {
            if (Schema::hasColumn('product_details_sections', 'banner_name_bn')) {
                $table->dropColumn('banner_name_bn');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
