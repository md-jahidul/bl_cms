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
            [ 'name' => 'Prepaid Plans', 'type' => 1, 'description' => 'Description 1'],
            [ 'name' => 'Start-up offers', 'type' => 1, 'description' => 'Description 2'],
            [ 'name' => 'Postpaid Plans', 'type' => 2, 'description' => 'Description 1'],
            [ 'name' => 'Icon Plans', 'type' => 2, 'description' => 'Description 2'],
        ];

        $other_offer_categories = [
            [ 'name' => 'Balance Transfer', 'type' => 1, 'description' => 'Description 1'],
            [ 'name' => 'Emergency Balance', 'type' => 1, 'description' => 'Description 2'],
            [ 'name' => 'Amar Offer', 'type' => 1, 'description' => 'Description 3'],
            [ 'name' => 'Bondho SIM Offer', 'type' => 1, 'description' => 'Description 4'],
            [ 'name' => 'MNP offers', 'type' => 1, 'description' => 'Description 5'],
            [ 'name' => 'Device Offers', 'type' => 1, 'description' => 'Description 6'],
            [ 'name' => '4G offers', 'type' => 1, 'description' => 'Description 7'],
            [ 'name' => 'Amar Offer', 'type' => 2, 'description' => 'Description 1'],
        ];


        foreach ($offers as $offer) {
            $myOffer = factory(OfferCategory::class)->create(
                [
                    'name' => $offer,
                    'alias' => strtolower(str_replace(' |-', '_', $offer))
                ]
            );

            if ($offer == 'Packages') {
                foreach ($package_categories as $category) {
                    factory(OfferCategory::class)->create(
                        [
                            'name' => $category['name'],
                            'alias' => strtolower(str_replace(str_split('\/:*?" -<>|'), '_', $category['name'])),
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
//                            'alias' => strtolower(str_replace(' ', '_', $other_package['name'])),

                            'alias' => strtolower(str_replace(str_split('\/:*?" -<>|'),'_', $other_package['name'])),
                            'type_id' => $other_package['type'],
                            'parent_id' => $myOffer->id
                        ]
                    );
                }
            }
        }
    }
}
