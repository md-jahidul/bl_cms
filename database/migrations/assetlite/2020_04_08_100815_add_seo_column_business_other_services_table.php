<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoColumnBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('alt_text');
            $table->text('schema_markup')->nullable()->after('alt_text');
            $table->string('url_slug')->nullable()->after('alt_text');
            $table->string('banner_name', 200)->nullable()->after('alt_text');
            $table->string('banner_image_mobile')->nullable()->after('alt_text');
        });
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
