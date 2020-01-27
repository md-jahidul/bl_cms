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
        ShortCode::truncate();
        $homePageComponentList = [
            [
                'page_id' => 1,
                'component_title' => 'Hero Slider',
                'component_type' => 'slider_single',
                'component_id'   =>  1
            ],
            [
                'page_id' => 1,
                'component_title' => 'Recharge',
                'component_type' => 'recharge',
                'component_id'   =>  null
            ],
            [
                'page_id' => 1,
                'component_title' => 'Quick Launch Items',
                'component_type' => 'quicklaunch',
                'component_id'   =>  null
            ],
            [
                'page_id' => 1,
                'component_title' => 'Trending Slider',
                'component_type' => 'slider_multiple',
                'component_id'   =>  2
            ],
            [
                'page_id' => 1,
                'component_title' => 'Digital Service',
                'component_type' => 'slider_single',
                'component_id'   =>  3
            ],
            [
                'page_id' => 1,
                'component_title' => 'Life Style & Benefits',
                'component_type' => 'slider_multiple',
                'component_id'   =>  4
            ],
            [
                'page_id' => 1,
                'component_title' => 'Testimonial Slider',
                'component_type' => 'slider_single',
                'component_id'   =>  5,
                'limit' => 5
            ],
//            [
//                'page_id' => 2,
//                'component_title' => 'Amar Offer',
//                'component_type' => 'amar_offer',
//                'component_id'   =>  1,
//            ]
        ];

        foreach ($homePageComponentList as $item) {
            ShortCode::create([
                'page_id' => $item['page_id'],
                'component_title' => $item['component_title'],
                'component_type' => $item['component_type'],
                'component_id' => $item['component_id']
            ]);
        }
    }
}
