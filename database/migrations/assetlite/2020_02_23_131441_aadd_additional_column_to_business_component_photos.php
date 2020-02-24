<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AaddAdditionalColumnToBusinessComponentPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_component_photos', function (Blueprint $table) {
            $table->string('alt_text_one', 250)->nullable()->after('photo_one');
            $table->string('alt_text_two', 250)->nullable()->after('photo_two');
            $table->string('alt_text_three', 250)->nullable()->after('photo_three');
            $table->string('alt_text_four', 250)->nullable()->after('photo_four');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_component_photos', function (Blueprint $table) {
            //
        });
    }
}
