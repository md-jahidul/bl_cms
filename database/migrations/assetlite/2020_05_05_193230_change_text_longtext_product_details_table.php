<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTextLongtextProductDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('product_details', function (Blueprint $table) {
            $table->longText('details_en')->change();
            $table->longText('details_bn')->change();
            $table->longText('offer_details_en')->change();
            $table->longText('offer_details_bn')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('product_details', function (Blueprint $table) {
            $table->mediumText('details_en')->change();
            $table->mediumText('details_bn')->change();
            $table->text('offer_details_en')->change();
            $table->text('offer_details_bn')->change();
        });
    }

}
