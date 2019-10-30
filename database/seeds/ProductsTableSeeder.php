<?php

use Illuminate\Database\Seeder;
use App\Models\SimCategory;
use App\Models\OfferCategory;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{

    public function getOfferInfo($name)
    {
        // [ 1,3,7,15,30,90 ]

        $obj = [];
        switch ($name) {
            case 'internet':
//                $obj->internet_volume_mb = rand(100, 12000);
                $obj = [
                    'internet_volume_mb' => 512 * rand(1, 20),
                    'validity_days' => rand(1, 90),
                    'inspiration_quote_en' => '',
                    'inspiration_quote_bn' => '',
                ];
                break;

            case 'voice':
                $obj = [
                    'internet_volume_mb' => 512 * rand(1, 20),
                    'validity_days' => '90',
                    'inspiration_quote_en' => 'Most Popular',
                    'inspiration_quote_bn' => 'সবচেয়ে জনপ্রিয়',
                ];
                break;

            case 'packages':
                $obj = [
                    'callrate_offer' =>  1,
                    'sms_rate_offer' =>  1,
                ];
                break;

            case 'bundles':
//                $obj->sms_volume = rand(50, 500);
//                $obj->min_volume = rand(50, 500);
//                $obj->internet_volume_mb = rand(100, 12000);

                $obj = [
                    'minute_volume' => '550',
                    'internet_volume_mb' => '250',
                    'sms_volume' => '150',
                    'validity_days' => '60',
                    'inspiration_quote_en' => 'Most Popular',
                    'inspiration_quote_bn' => 'সবচেয়ে জনপ্রিয়',
                ];

                break;

            case 'others':
                break;

            case 'startup':
                $obj = [
                    'callrate_offer' => '1',
                    'callrate_short_note__en' => '*Including all',
                    'callrate_short_note_bn' => '* সব সহ',
                    'internet_offer_mb' => '300',
                    'minute_offer' => '450',
                    'sms_offer' => '170',
                    'validity_days' => '90',
                ];

                break;

            case 'bussiness':
                break;
        }

        return $obj;
    }


    public function showInHome($offerType)
    {
        if (in_array($offerType, ['internet', 'voice', 'bundles'])) {
            return rand(0, 2) ? 1 : 0;
        }

        return 0;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Prepaid,

        $countHomePageOffer = 0;

        for ($i = 0; $i < 20; $i++) {
            $offer = OfferCategory::whereIn('alias', ['internet','packages','others'])->inRandomOrder()->first();
            $offerInfo = $this->getOfferInfo($offer->alias);

            $showInHome = $this->showInHome($offer->alias);
            $displayOrder = $showInHome ? ++$countHomePageOffer : 0;

            factory(Product::class)->create(
                [
                    'code' => 'ABC' . $i,
                    'name_en' => 'ABC' . $i,
                    'name_bn' => 'ABC' . $i,
                    'price_tk' => rand(10, 100),
                //  'internet_volume_mb' =>  $offerInfo->internet_volume_mb ?? null,
                    'ussd_en' => '*' . rand(1000, 9999) . '*' . '1#',
                    'sim_category_id' => SimCategory::where('alias', 'postpaid')->first('id'),
                    'offer_category_id' => $offer->id,
                    'show_in_home' => $showInHome,
                    'display_order' => $displayOrder,
                    'offer_info' =>  $this->getOfferInfo($offer->alias)
                ]
            );
        }

        for ($i = 0; $i < 30; $i++) {
            $offer = OfferCategory::inRandomOrder()->first();
            $offerInfo = $this->getOfferInfo($offer->alias);

            $showInHome = $this->showInHome($offer->alias);
            $displayOrder = $showInHome ? ++$countHomePageOffer : 0;

            factory(Product::class)->create(
                [
                    'code' => 'ABC' . $i,
                    'name_en' => 'ABC' . $i,
                    'name_bn' => 'ABC' . $i,
                    'price_tk' => rand(10, 100),
                //                    'sms_volume' => $offerInfo->sms_volume ?? null,
                //                    'min_volume' => $offerInfo->min_volume ?? null,
                //                    'internet_volume_mb' =>  $offerInfo->internet_volume_mb ?? null,
                //                    'validity_days' => rand(1, 10),
                    'ussd_en' => '*' . rand(1000, 9999) . '*' . '1#',
                    'sim_category_id' => SimCategory::where('alias', 'prepaid')->first('id'),
                    'offer_category_id' => $offer->id,
                    'show_in_home' => $showInHome,
                    'display_order' => $displayOrder,
                    'offer_info' =>  $this->getOfferInfo($offer->alias)
                ]
            );
        }
    }
}
/*


offer_info

internet
        offer_info {
            internet_volume_mb :
            validity_days :
            inspiration_quote_en :
            inspiration_quote_bn :
        }


voice
        offer_info {
            minute_volume :
            validity_days :
            inspiration_quote_en :
            inspiration_quote_bn :
        }


bundle

        offer_info {
            minute_volume :
            internet_volume_mb :
            sms_volume :
            validity_days :
            inspiration_quote_en :
            inspiration_quote_bn :
        }



Packages
        offer_info{
            callrate_offer :  1
            sms_rate_offer :  1
        }



Startup {
    callrate_offer :  1
    internet_offer_mb :
    minute_offer :
    sms_offer :
    validity_days :
    callrate_short_note_en :
    callrate_short_note_bn :
    gb_short_note_en :
    gb_short_note_bn :

}

*/


