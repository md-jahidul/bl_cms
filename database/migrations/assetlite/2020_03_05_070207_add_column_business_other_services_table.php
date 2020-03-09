<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBusinessOtherServicesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('business_other_services', function (Blueprint $table) {
            $table->string('home_short_details_en', 250)->nullable()->after('name_bn');
            $table->string('home_short_details_bn', 250)->nullable()->after('name_bn');
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
