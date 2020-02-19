<?php

use App\Models\MyBlInternetOffersCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyBlInternetOfferCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_bl_internet_offers_categories')->truncate();

        $category = ['Exclusive Pack','Power Pack','Weekly Pack','Monthly Pack', 'Social Pack'];
        foreach ($category as $key => $val) {
            MyBlInternetOffersCategory::create(
                [
                    'name' => $val,
                    'sort' => $val + 1,
                    'slug' => strtolower(str_replace(' ', '_', $val))
                ]
            );
        }
    }
}
