<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeGuestCustomerActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guest_customer_activities', function (Blueprint $table) {
            $table->text('page_name')->change();
            $table->text('failed_reason')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_customer_activities', function (Blueprint $table) {
            $table->string('page_name')->change();
            $table->string('failed_reason')->change();
        });
    }
}
