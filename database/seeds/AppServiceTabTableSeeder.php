<?php

use App\Models\AppServiceTab;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppServiceTabTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS =0;');

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

        DB::statement('SET FOREIGN_KEY_CHECKS =1;');
    }
}
