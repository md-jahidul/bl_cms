<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateEcarrerPortalItemsTable extends Migration
{   
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecarrer_portal_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ecarrer_portals_id')->comment('ecarrer_portals table foreign key');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('description_en', 2000)->nullable();
            $table->string('description_bn', 2000)->nullable();
            $table->string('image', 2000)->nullable();
            $table->string('video', 2000)->nullable();
            $table->string('alt_text')->nullable();
            $table->string('alt_links')->nullable();
            $table->string('call_to_action', 2000)->nullable();
            $table->json('additional_info')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('active = 1, inactive = 0');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ecarrer_portals_id')
                ->references('id')
                ->on('ecarrer_portals')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecarrer_portal_items');
    }
}
