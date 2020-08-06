<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessFeatures extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('business_features', function (Blueprint $table) {
            $table->string('alt_text', 250)->nullable()->after('icon_url');
            $table->string('title_bn', 250)->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('business_features', function (Blueprint $table) {
            //
        });
    }

}
