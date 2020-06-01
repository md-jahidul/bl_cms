<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TestLongtextComponentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('components', function (Blueprint $table) {
            $table->longText('description_en')->change();
            $table->longText('description_bn')->change();
            $table->longText('editor_en')->change();
            $table->longText('editor_bn')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('components', function (Blueprint $table) {
            $table->text('description_en')->change();
            $table->text('description_bn')->change();
            $table->text('editor_en')->change();
            $table->text('editor_bn')->change();
        });
    }

}
