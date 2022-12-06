<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComponentTypeInPriyojonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            $table->string('component_type')->after('parent_id')->nullable();
            $table->mediumText('desc_en')->after('title_bn')->nullable();
            $table->mediumText('desc_bn')->after('desc_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            $table->dropColumn('component_type');
            $table->dropColumn('desc_en');
            $table->dropColumn('desc_bn');
        });
    }
}
