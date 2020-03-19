<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifySearchDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_data', function (Blueprint $table) {
            $table->renameColumn('product_name', 'keyword');
            $table->renameColumn('product_id', 'keyword_id');
            $table->string('keyword_type', 100)->nullable()->after('product_id');
        });
      
         DB::statement('ALTER TABLE search_data ADD FULLTEXT search(keyword, tag)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
