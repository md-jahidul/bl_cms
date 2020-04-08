<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMyBlSearchContentsTable
 */
class CreateMyBlSearchContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_search_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display_title')->unique();
            $table->string('description')->nullable();
            $table->json('search_content');
            $table->string('navigation_action');
            $table->string('other_contents')->nullable();
            $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('my_bl_search_contents');
    }
}
