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
                'component_type' => 'slider',
                'component_id'   =>  1
            ],
            [
                'component_type' => 'recharge',
                'component_id'   =>  null
            ],
            [
                'component_type' => 'quicklaunch',
                'component_id'   =>  null
            ],
            [
                'component_type' => 'slider',
                'component_id'   =>  2
            ],
            [
                'component_type' => 'slider',
                'component_id'   =>  3
            ]
        ];

        foreach ($homePageComponentList as $item) {
            ShortCode::create([
                'page_id' => 1,
                'component_type' => $item['component_type'],
                'component_id' => $item['component_id']
            ]);
        }
    }
}
