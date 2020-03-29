<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdditionalFieldAddInLeadRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_requests', function (Blueprint $table) {
            $table->string('category')->after('id')->nullable();
            $table->string('sub_category')->after('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_requests', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('sub_category');
        });
    }
}
