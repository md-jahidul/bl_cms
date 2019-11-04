<?php

use Illuminate\Database\Seeder;
use App\Models\OfferCategory;
use Illuminate\Support\Facades\DB;

class OfferCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = ['Internet','Voice','Bundles','Packages','Others'];

        $package_categories = [
            [ 'name' => 'Startup offer', 'type' => 1, 'description' => 'Description 3'],
            [ 'name' => 'Icon plan', 'type' => 2, 'description' => 'Description 1'],
            [ 'name' => 'Icon package', 'type' => 2, 'description' => 'Description 2']
        ];

        $other_offer_categories = [
            [ 'name' => 'Balance Transfer', 'type' => 1, 'description' => 'Description 3'],
            [ 'name' => 'Emergency Balance', 'type' => 1, 'description' => 'Description 3'],
            [ 'name' => 'Amar Offer', 'type' => 1, 'description' => 'Description 3'],
            [ 'name' => 'Bondho SIM Offer', 'type' => 1, 'description' => 'Description 3'],
            [ 'name' => 'MFS Offers', 'type' => 2, 'description' => 'Description 1'],
            [ 'name' => 'Device Offers', 'type' => 2, 'description' => 'Description 2'],
            [ 'name' => 'MMP4G Offers', 'type' => 2, 'description' => 'Description 2']
        ];

//        $other_packages = [
//            ['Balance Transfer','Emergency Balance','Amar Offer','Bondho SIM Offer','MFS Offers','Device Offers','MMP4G Offers']
//        ];

        foreach ($offers as $offer) {
            $myOffer = factory(OfferCategory::class)->create(
                [
                    'name' => $offer,
                    'alias' => strtolower(str_replace(' ', '_', $offer))
                ]
            );

            if ($offer == 'Packages') {
                foreach ($package_categories as $category) {
                    factory(OfferCategory::class)->create(
                        [
                            'name' => $category['name'],
                            'alias' => strtolower(str_replace(' ', '_', $category['name'])),
                            'type_id' => $category['type'],
                            'parent_id' => $myOffer->id
                        ]
                    );
                }
            }

            if ($offer == 'Others') {
                foreach ($other_offer_categories as $other_package) {
                    factory(OfferCategory::class)->create(
                        [
                            'name' => $other_package['name'],
                            'alias' => strtolower(str_replace(' ', '_', $other_package['name'])),
                            'type_id' => $other_package['type'],
                            'parent_id' => $myOffer->id
                        ]
                    );
                }
            }
        }
    }
}
