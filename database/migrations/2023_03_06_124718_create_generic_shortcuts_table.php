<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericShortcutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_shortcuts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('generic_shortcut_master_id');
            $table->string('title');
            $table->text('icon');
            $table->string('customer_type');
            $table->string('component_identifier');
            $table->tinyinteger('is_default')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generic_shortcuts');
    }
}
