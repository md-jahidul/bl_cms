<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInAboutUsEcareerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_ecareer_items', function (Blueprint $table) {
            if (!Schema::hasColumn('about_us_ecareer_items', 'image_name')) {
                $table->string('image_name')->after('image')->nullable();
                $table->string('image_name_bn')->after('image_name')->nullable();
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
        Schema::table('about_us_ecareer_items', function (Blueprint $table) {
            if (Schema::hasColumn('about_us_ecareer_items', 'image_name')) {
                $table->dropColumn('image_name');
                $table->dropColumn('image_name_bn');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
