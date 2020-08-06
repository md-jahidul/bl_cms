<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnBusinessOtherServicesTable extends Migration {

      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->text('offer_details_en')->nullable()->after('short_details_bn');
            $table->dropColumn('offer_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }


}
