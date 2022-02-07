<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInMyblFlashHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_flash_hours', function (Blueprint $table) {
            $table->string('campaign_user_type')->nullable()->after('reference_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_flash_hours', function (Blueprint $table) {
            $table->dropColumn('campaign_user_type');
        });
    }
}
