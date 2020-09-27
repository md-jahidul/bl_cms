<?php

use App\Models\FourGLandingPage;
use Illuminate\Database\Seeder;

class FourGLandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('four_g_landing_pages')->truncate();
        $titleEn = ['4G Campaign','Internet Offers','4G Devices', '4G Coverage', null];
        $titleBn = ['4G ক্যাম্পেইন','ইন্টারনেট অফার','4G ডিভাইস','4G কভারেজ', null];
        $componentTypes = ['four_g_campaign','internet_offers','four_g_devices','four_g_coverage', 'banner_image'];

        foreach ($componentTypes as $key => $item) {
            FourGLandingPage::create([
                'title_en' => $titleEn[$key],
                'title_bn' => $titleBn[$key],
                'component_type' => $item,
                'status' => 1,
            ]);
        }
    }
}
