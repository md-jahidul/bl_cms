<?php

use Illuminate\Database\Seeder;
use App\Models\OfferCategory;

class OfferCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = ['Internet','Voice','Bundles','Packages','Others', 'Startup', 'Business'];
        foreach ($offers as $offer) {
            factory(OfferCategory::class)->create(
                [
                    'name' => $offer,
                    'alias' => strtolower(str_replace(' ', '_', $offer))
                ]
            );
        }
    }
}
