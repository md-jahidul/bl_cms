<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoamingGeneralPagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('roaming_general_pages', function (Blueprint $table) {

            if (!Schema::hasColumn('roaming_general_pages', 'short_description_en')) {
                $table->text('short_description_en')->after('title_bn');
            }
            if (!Schema::hasColumn('roaming_general_pages', 'short_description_bn')) {
                $table->text('short_description_bn')->after('title_bn');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
