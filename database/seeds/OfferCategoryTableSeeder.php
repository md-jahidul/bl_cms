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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        OfferCategory::truncate();

        $offers = ['Internet', 'Voice', 'Bundles', 'Packages', 'Others', 'Call Rate'];
        $offersBn = ['ইন্টারনেট', 'ভয়েস', 'বান্ডেলগুলি', 'প্যাকেজগুলি', 'অন্যরা', 'কল রেট'];

        $package_categories = [
            ['name' => 'Prepaid Plans', 'type' => 1, 'description' => 'Description 1'],
            ['name' => 'Start-up offers', 'type' => 1, 'description' => 'Description 2'],
            ['name' => 'Postpaid Plans', 'type' => 2, 'description' => 'Description 1'],
            ['name' => 'Icon Plans', 'type' => 2, 'description' => 'Description 2'],
//            ['name' => 'Propaid Plans', 'type' => 2, 'description' => 'Description 2'],
        ];

        $package_categoriesBn = ['প্রিপেইড প্ল্যানস', 'স্টার্ট-আপ অফার', 'পোস্টপেইড প্ল্যানস', 'আইকন প্ল্যানস'
//            'প্রিপেইড প্ল্যানস'
        ];

        $other_offer_categories = [
            ['name' => 'Balance Transfer', 'type' => 1, 'description' => 'Description 1'],
            ['name' => 'Emergency Balance', 'type' => 1, 'description' => 'Description 2'],
            ['name' => 'Amar Offer', 'type' => 1, 'description' => 'Description 3'],
            ['name' => 'Bondho SIM Offer', 'type' => 1, 'description' => 'Description 4'],
            ['name' => 'MNP offers', 'type' => 1, 'description' => 'Description 5'],
            ['name' => 'Device Offers', 'type' => 1, 'description' => 'Description 6'],
            ['name' => '4G offers', 'type' => 1, 'description' => 'Description 7'],
            ['name' => 'Amar Offer', 'type' => 2, 'description' => 'Description 1'],
            ['name' => 'MFS Offers', 'type' => 1, 'description' => 'Description 8'],
        ];

        $other_offer_categoriesBn = [
            'ব্যালান্স ট্রান্সফার',
            'ইমারজেন্সি ব্যালেন্স',
            'আমার অফার',
            'বন্ধু সিম অফার',
            'এমএনপি অফার',
            'ডিভাইস অফার',
            '4G অফার',
            'আমার অফার',
            'এমএফএস অফার'
        ];

        $i = 0;
        foreach ($offers as $key => $offer) {
            $myOffer = factory(OfferCategory::class)->create(
                [
                    'name_en' => $offer,
                    'name_bn' => $offersBn[$i++],
                    'alias' => strtolower(str_replace(str_split('\/:*?" -<>|'), '_', $offer)),
                ]
            );

            if ($offer == 'Packages') {
                foreach ($package_categories as $key => $category) {
                    factory(OfferCategory::class)->create(
                        [
                            'name_en' => $category['name'],
                            'name_bn' => $package_categoriesBn[$key],
                            'alias' => strtolower(str_replace(str_split('\/:*?" -<>|'), '_', $category['name'])),
                            'type_id' => $category['type'],
                            'parent_id' => $myOffer->id
                        ]
                    );
                }
            }

            if ($offer == 'Others') {
                foreach ($other_offer_categories as $key => $other_package) {
                    factory(OfferCategory::class)->create(
                        [
                            'name_en' => $other_package['name'],
                            'name_bn' => $other_offer_categoriesBn[$key],
                            'alias' => strtolower(str_replace(str_split('\/:*?" -<>|'), '_', $other_package['name'])),
                            'type_id' => $other_package['type'],
                            'parent_id' => $myOffer->id
                        ]
                    );
                }
            }
        }

        OfferCategory::create([
            'id' =>  20,
            'parent_id' =>  4,
            'name_en' => "Propaid Plans",
            'name_bn' =>  'প্রিপেইড প্ল্যানস',
            'alias' => "propaid_plans",
            'type_id' => 2,
        ]);
    }
}
