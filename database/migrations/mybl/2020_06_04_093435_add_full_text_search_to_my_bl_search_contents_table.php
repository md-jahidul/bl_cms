<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddFullTextSearchToMyBlSearchContentsTable
 */
class AddFullTextSearchToMyBlSearchContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE my_bl_search_contents ADD FULLTEXT fulltext_index (display_title,navigation_action,search_content)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_search_contents', function (Blueprint $table) {
            $table->dropIndex('fulltext_index');
        });
    }
}
