<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericRailItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_rail_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('generic_rail_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('icon')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_highlight')->default(false);
            $table->string('deeplink')->nullable();
            $table->integer('display_order');
            $table->string('user_type')->default('all');
            $table->bigInteger('android_version_code_min')->default(0);
            $table->bigInteger('android_version_code_max')->default(999999999);
            $table->bigInteger('ios_version_code_min')->default(0);
            $table->bigInteger('ios_version_code_max');
            $table->timestamps();
            $table->foreign('generic_rail_id')
                ->references('id')
                ->on('generic_rails')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generic_rail_items');
    }
}
