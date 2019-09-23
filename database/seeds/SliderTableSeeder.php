<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $sliders = ['Hero','Explore Devices','Digital Services','Testimonial'];
        $sliders = ['Hero', 'Digital Services', 'Testimonial'];

        foreach ($sliders as $key => $slider){
            Slider::create([
                'title' =>  'Home page ' . $slider,
                'component_id' => ++$key,
                'description' => 'Description of ' . $slider,
                'short_code' => '[slider_'.++$key .']',
                'platform' => 'web',
                'other_attributes' => [
                    'sliding_speed' => '5',
                ]
            ]);
        }
    }
}
