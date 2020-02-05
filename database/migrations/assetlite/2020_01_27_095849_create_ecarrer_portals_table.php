<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateEcarrerPortalsTable extends Migration
{   
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecarrer_portals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_en');
            $table->string('title_bn')->nullable();
            $table->string('slug')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('video', 2000)->nullable();
            $table->string('alt_text')->nullable();
            $table->string('category', 50);
            $table->string('route_slug')->nullable();
            $table->string('category_type', 50)->nullable();
            $table->json('additional_info')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('active = 1, inactive = 0');
            $table->tinyInteger('has_items')->default(0)->comment('Has child items = 1, No child items = 0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecarrer_portals');
    }
}
