<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('product_code');
            $table->text('schema_markup')->nullable()->after('product_code');
            $table->string('url_slug')->nullable()->after('product_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug');
        });
    }
}
