<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateComponentsTable extends Migration
{
    use SoftDeletes;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('section_details_id')->comment('service product details page table id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('slug')->nullable();

            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();

            $table->text('editor_en')->nullable();
            $table->text('editor_bn')->nullable();

            $table->string('image')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('video', 500)->nullable();
            $table->string('alt_links')->nullable();
            $table->integer('component_order')->nullable();

            $table->tinyInteger('status')->default(1);
            $table->json('other_attributes')->nullable();
            $table->timestamps();

            // $table->foreign('section_details_id')
            //     ->references('id')
            //     ->on('app_service_product_details')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
