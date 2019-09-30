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
        $partnerCategoryEn = ["Restaurant", "Fashion","Coffee Shop","Coffee Shop"];
        $partnerCategoryBn = ["রেস্তোঁরা", "ফ্যাশন", "কফি শপ", "Coffee Shop"];

        foreach ($partnerCategoryEn as $key => $value){
            PartnerCategory::create([
                'name_en' => $value,
                'name_bn' => $partnerCategoryBn[$key]
            ]);
        }
    }
}
