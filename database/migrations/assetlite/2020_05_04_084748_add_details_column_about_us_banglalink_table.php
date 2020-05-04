<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsColumnAboutUsBanglalinkTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            $table->longText('details_bn')->nullable()->after('banglalink_info_bn');
            $table->longText('details_en')->nullable()->after('banglalink_info_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('about_us_banglalink', function (Blueprint $table) {
            $table->dropColumn('details_bn');
            $table->dropColumn('details_en');
        });
    }

}
