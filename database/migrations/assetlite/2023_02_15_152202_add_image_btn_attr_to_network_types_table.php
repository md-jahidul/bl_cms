<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageBtnAttrToNetworkTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('network_types', function (Blueprint $table) {
            $table->string('image_url')->after('slug')->nullable();
            $table->string('mobile_view_img')->after('slug')->nullable();
            $table->string('alt_text_en')->after('slug')->nullable();
            $table->string('alt_text_bn')->after('slug')->nullable();
            $table->string('mobile_alt_text_en')->after('slug')->nullable();
            $table->string('mobile_alt_text_bn')->after('slug')->nullable();
            $table->longtext('other_attributes')->after('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('network_types', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->dropColumn('mobile_view_img');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('mobile_alt_text_en');
            $table->dropColumn('mobile_alt_text_bn');
            $table->dropColumn('other_attributes');
        });
    }
}
