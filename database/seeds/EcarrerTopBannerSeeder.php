<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EcarrerTopBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $top_banner = [
            [
                'title_en' => 'Life At Banglalink',
                'slug' => 'life_at_banglalink',
                'category' => 'life_at_bl_topbanner',
                'route_slug' => 'life-at-banglalink/topbanner',
                'category_type' => 'life_at_banglalink',
                'is_active' => 1,
                'has_items' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'title_en' => 'Programs',
                'slug' => 'programs',
                'category' => 'life_at_bl_topbanner',
                'route_slug' => 'life-at-banglalink/topbanner',
                'category_type' => 'programs',
                'is_active' => 1,
                'has_items' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'title_en' => 'Vacancy',
                'slug' => 'vacancy',
                'category' => 'life_at_bl_topbanner',
                'route_slug' => 'life-at-banglalink/topbanner',
                'category_type' => 'vacancy',
                'is_active' => 1,
                'has_items' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
            
        ];
        DB::table('ecarrer_portals')->insert($top_banner);
    }
}
