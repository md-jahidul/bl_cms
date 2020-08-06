<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewColumnAppServiceProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->integer('app_review')->nullable()->after('dial_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->dropColumn('app_review');
        });
    }

}
