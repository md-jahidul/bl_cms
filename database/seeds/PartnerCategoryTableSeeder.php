<?php

use App\Models\PartnerCategory;
use Illuminate\Database\Seeder;

class PartnerCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partnerCategoryEn = ["Hotels", "Restaurants", "Hospitals", "Services", "Fashion"];
        $partnerCategoryBn = ["হোটেল", "রেস্তোঁরাগুলি", "হাসপাতালগুলি", "পরিষেবাগুলি", "ফ্যাশন"];

        foreach ($partnerCategoryEn as $key => $value) {
            PartnerCategory::create([
                'name_en' => $value,
                'name_bn' => $partnerCategoryBn[$key]
            ]);
        }
    }
}
