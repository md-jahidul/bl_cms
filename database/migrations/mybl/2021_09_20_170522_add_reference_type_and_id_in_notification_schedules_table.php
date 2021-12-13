<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenceTypeAndIdInNotificationSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_schedules', function (Blueprint $table) {
            $table->integer('reference_id')->after('end')->nullable();
            $table->string('reference_type')->after('reference_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_schedules', function (Blueprint $table) {
            $table->dropColumn("reference_id");
            $table->dropColumn("reference_type");
        });
    }
}
