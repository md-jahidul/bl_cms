<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutPriyojonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_priyojons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->default('about_priyojon');
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->text('left_side_img')->nullable();
            $table->text('right_side_ing')->nullable();
            $table->json('other_attributes')->nullable();
            $table->timestamps();
        });

        \App\Models\AboutPriyojon::create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_priyojons');
    }
}
