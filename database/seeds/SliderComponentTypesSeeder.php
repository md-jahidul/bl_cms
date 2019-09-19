<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderComponentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider_types = ['Hero','Digital Services','Explore Devices','Testimonial'];

        $slider_component_types = [];

        foreach ($slider_types as $slider) {
            $slider_component_types[] = [
                'name' => $slider,
                'slug' => str_replace( " ", "", $slider)
            ];
        }

        DB::table('slider_component_types')->insert($slider_component_types);
    }
}
