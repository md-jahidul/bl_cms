<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->index();
            $table->string('url_slug')->nullable()->index();
            $table->string('url_slug_bn')->nullable();
            $table->text('schema_markup')->nullable();
            $table->text('page_header_en')->nullable();
            $table->text('page_header_bn')->nullable();
            $table->boolean('status')->default(0)->index();
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
        Schema::dropIfExists('new_pages');
    }
}
