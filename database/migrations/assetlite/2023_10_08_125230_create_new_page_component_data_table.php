<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPageComponentDataTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_page_component_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('component_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('key')->nullable();
            $table->text('value_en')->nullable();
            $table->text('value_bn')->nullable();
            $table->double('group')->default(0);
            $table->timestamps();
            $table->foreign('component_id')
                ->references('id')
                ->on('new_page_components')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_page_component_data');
    }
};
