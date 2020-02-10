<?php

use Illuminate\Database\Seeder;
use App\AppServiceTab;

class AppServiceTabTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppServiceTab::truncate();

        $appServiceTabsEn = ['App', 'VAS', 'Financial', 'Others'];
        $appServiceTabsBn = ['অ্যাপ', 'ভ্যাস', 'আর্থিক', 'অন্যান্য'];

        foreach ($appServiceTabsEn as $key => $item) {
            AppServiceTab::create([
                'name_en' => $item,
                'name_bn' => $appServiceTabsBn[$key],
                'alias' => str_replace(' ', '_', strtolower($item))
            ]);
        }
    }
}
