<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPageComponentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_page_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('page_id')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable()->index();
            $table->mediumText('attribute')->nullable();
            $table->text('config')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('status')->default(0)->index();
            $table->timestamps();
            $table->foreign('page_id')
                ->references('id')
                ->on('new_pages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_page_components');
    }
};
