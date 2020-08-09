<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMyBlFeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_feed_categories', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
            $table->renameColumn('ordering', 'order');
            $table->unsignedBigInteger('parent_id')->after('id')->nullable()->default(null);
            //$table->foreign('parent_id')->references('id')->on('my_bl_feed_categories')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_feed_categories', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->renameColumn('order', 'ordering');
            $table->dropColumn('parent_id');
        });
    }
}
