<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchemaMarkupInBeAPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('be_a_partners', function (Blueprint $table) {
            $table->longText('schema_markup')->nullable()->after('page_header_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('be_a_partners', function (Blueprint $table) {
            $table->dropColumn('schema_markup');
        });
    }
}
