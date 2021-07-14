<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyblSliderComponentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS =0;");
        DB::table('slider_component_types')->truncate();
        $slider_types = [
          1 => 'Home',
          2 => 'Dashboard',
          5 => 'Internet',
          6 => 'Bundle',
          7 => 'History',
          13 => 'Recharge Offers',
          14 => 'Special Call Rate',
          15 => 'Minute Packs',
          16 => 'SMS Packs',
          17 => 'Amer Offer',
          18 => 'Home Secondary Slider'
        ];

        $slider_component_types = [];

        foreach ($slider_types as $key => $slider) {
            $slider_component_types[] = [
                'id' => $key,
                'name' => $slider,
                'slug' => str_replace(" ", "", $slider)
            ];
        }

        DB::table('slider_component_types')->insert($slider_component_types);
        DB::statement("SET FOREIGN_KEY_CHECKS =1;");
    }
}
