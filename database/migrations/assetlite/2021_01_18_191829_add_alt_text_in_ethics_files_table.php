<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAltTextInEthicsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ethics_files', function (Blueprint $table) {
            if (!Schema::hasColumn('ethics_files', 'alt_text')) {
                $table->string('alt_text')->after('file_path')->nullable();
                $table->string('alt_text_bn')->after('alt_text')->nullable();
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
        Schema::table('ethics_files', function (Blueprint $table) {
            if (Schema::hasColumn('ethics_files', 'alt_text')) {
                $table->dropColumn('alt_text');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
