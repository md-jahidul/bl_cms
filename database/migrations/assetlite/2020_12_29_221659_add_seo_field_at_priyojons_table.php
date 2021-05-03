<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldAtPriyojonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            if (!Schema::hasColumn('priyojons', 'page_header')) {
                $table->text('page_header')->after('banner_name')->nullable();
                $table->text('page_header_bn')->after('page_header')->nullable();
                $table->text('schema_markup')->after('page_header_bn')->nullable();
            }

            /* drop some existing column */
            if (Schema::hasColumn('priyojons', 'banner_name_mobile_en')) {
                $table->dropColumn(['banner_name_mobile_en', 'banner_name_mobile_bn']);
            }

            /* rename existing column */
            if (Schema::hasColumn('priyojons', 'banner_name_web_bn')) {
                $table->renameColumn('banner_name_web_bn', 'banner_name_bn');
            }
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
            if (Schema::hasColumn('priyojons', 'page_header')) {
                $table->dropColumn('page_header');
                $table->dropColumn('page_header_bn');
                $table->dropColumn('schema_markup');
            }

            if (!Schema::hasColumn('priyojons', 'banner_name_mobile_en')) {
                $table->string('banner_name_mobile_en')->nullable();
                $table->string('banner_name_mobile_bn')->nullable();
            }

            if (Schema::hasColumn('priyojons', 'banner_name_bn')) {
                $table->renameColumn('banner_name_bn', 'banner_name_web_bn');
            }
        });
    }
}
