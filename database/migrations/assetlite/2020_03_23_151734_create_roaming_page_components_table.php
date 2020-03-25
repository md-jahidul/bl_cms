<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoamingPageComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roaming_page_components', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_type', 100)->comment("about,bill payemnt or info & tips");
            $table->mediumInteger('parent_id');
            $table->text('body_text_en');
            $table->text('body_text_bn');
            $table->tinyInteger('big_font')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('payment_block')->default(0)->comment('1=yes,0=no');
            $table->tinyInteger('position')->default(0);
            $table->string('component_type', 100)->comment("feature,highlighs, advance, list");
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
        Schema::dropIfExists('roaming_page_components');
    }
}
