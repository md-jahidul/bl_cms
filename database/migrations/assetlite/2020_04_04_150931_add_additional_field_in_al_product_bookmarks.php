<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInAlProductBookmarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_product_bookmarks', function (Blueprint $table) {
            $table->string('module_type')->nullable()->after('id');
            $table->string('category')->nullable()->after('module_type');
            $table->renameColumn('product_code', 'product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('al_product_bookmarks', function (Blueprint $table) {
            $table->dropColumn('module_type');
            $table->dropColumn('category');
            $table->renameColumn('product_id', 'product_code');
        });
    }
}
