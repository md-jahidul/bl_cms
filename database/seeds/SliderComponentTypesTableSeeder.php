<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderComponentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS =0;");
        DB::table('al_slider_component_types')->truncate();

        $slider_types =
            [
                'Hero',
                'Trending',
                'Digital Services',
                'Partner Offer',
                'Testimonial',
                'About-Media',
                'Explore Devices',
                'Home',
                'Dashboard',
            ];

        $slider_component_types = [];

        foreach ($slider_types as $slider) {
            $slider_component_types[] = [
                'name' => $slider,
                'slug' => str_replace(" ", "", $slider)
            ];
        }
        DB::table('al_slider_component_types')->insert($slider_component_types);
        DB::statement("SET FOREIGN_KEY_CHECKS =1;");
    }
}
