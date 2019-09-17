<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SliderImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\SliderImage', 10)->create();
    }
}
