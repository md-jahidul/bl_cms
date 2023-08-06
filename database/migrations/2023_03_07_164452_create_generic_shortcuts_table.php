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
            $table->unsignedBigInteger('generic_shortcut_master_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->text('icon');
            $table->string('customer_type');
            $table->string('component_identifier');
            $table->text('other_info')->nullable();
            $table->string('deep_link')->nullable();
            $table->integer('sort_order')->default(1);
            $table->tinyinteger('is_default')->default('0');
            $table->foreign('generic_shortcut_master_id')
                ->references('id')
                ->on('generic_shortcut_masters')
                ->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('generic_shortcuts');
    }
}
