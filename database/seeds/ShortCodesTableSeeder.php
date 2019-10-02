<?php

use Illuminate\Database\Seeder;
use App\Models\ShortCode;

class ShortCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homePageComponentList = [
            [
                'component_title' => 'Hero Slider',
                'component_type' => 'slider_single',
                'component_id'   =>  1
            ],
            [
                'component_title' => 'Recharge',
                'component_type' => 'recharge',
                'component_id'   =>  null
            ],
            [
                'component_title' => 'Quick Launch Items',
                'component_type' => 'quicklaunch',
                'component_id'   =>  null
            ],
            [
                'component_title' => 'Digital Service',
                'component_type' => 'slider_single',
                'component_id'   =>  2
            ],
            [
                'component_title' => 'Life Style & Benefits',
                'component_type' => 'slider_multiple',
                'component_id'   =>  4
            ],
            [
                'component_title' => 'Testimonial Slider',
                'component_type' => 'slider_single',
                'component_id'   =>  3,
                'limit' => 5
            ]
        ];

        foreach ($homePageComponentList as $item) {
            ShortCode::create([
                'page_id' => 1,
                'component_title' => $item['component_title'],
                'component_type' => $item['component_type'],
                'component_id' => $item['component_id']
            ]);
        }
    }
}
