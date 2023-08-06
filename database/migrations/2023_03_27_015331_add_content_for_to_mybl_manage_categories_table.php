<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentForToMyblManageCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_manage_categories', function (Blueprint $table) {
            $table->string('content_for')->default('bl')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_manage_categories', function (Blueprint $table) {
            $table->dropColumn('content_for');
        });
    }
}
