<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\Models\AboutPage;

class FrontendUrlContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('front_end_dynamic_routes')->truncate();
        $aboutPages = [
            [
                "code" => 'Prepaid',
                "exact" => true,
                "url" => '/en/prepaid/:section',
                "slug" => 'prepaid',
                "children" => [],
            ],
            [
                "code" => 'Prepaid',
                "exact" => true,
                "url" => '/bn/প্রিপেইড/:section',
                "slug" => 'prepaid',
                "children" => [],
            ],
        ];

        foreach ($aboutPages as $aboutPage) {
            \App\Models\FrontEndDynamicRoute::create($aboutPage);
        }
    }
}
