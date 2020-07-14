<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeaderScriptBnCreatorInBusinessPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->text('page_header_bn')->nullable()->after('page_header');
            $table->integer('created_by')->nullable()->after('updated_at');
            $table->integer('updated_by')->nullable()->after('created_by');
            $table->string('alt_text_bn')->nullable()->after('alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_packages', function (Blueprint $table) {
            $table->dropColumn('page_header_bn');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('alt_text_bn');
        });
    }
}
