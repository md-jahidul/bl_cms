<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVeonAdtechToGenericSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generic_sliders', function (Blueprint $table) {
            $table->string('ad_unit_id')->nullable()->after('is_card');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generic_sliders', function (Blueprint $table) {
            //
        });
    }
}
