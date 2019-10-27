<?php

use Illuminate\Database\Seeder;
use App\Models\SimCategory;
use App\Models\OfferCategory;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{

    public function getOfferInfo($name)
    {
        $obj = new stdClass();

        switch ($name) {
            case 'internet':
                $obj->sms_volume = rand(50, 500);
                break;

            case 'voice':
                $obj->min_volume = rand(50, 500);
                break;

            case 'packages':
                //$obj->min_volume = rand(50, 500);
                break;

            case 'bundles':
                $obj->sms_volume = rand(50, 500);
                $obj->min_volume = rand(50, 500);
                $obj->internet_volume_mb = rand(100, 12000);
                break;

            case 'others':
                break;

            case 'startup':
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


        /*

        Postpaid
                $table->string('code');
                $table->string('name');
                $table->integer('price_tk')->nullable();
                $table->string('ussd')->nullable();
                $table->unsignedBigInteger('sim_category_id');
                $table->unsignedBigInteger('offer_category_id');


        Prepaid
                $table->string('code');
                $table->string('name');
                $table->integer('price_tk')->nullable();
                $table->integer('sms_volume')->nullable();
                $table->integer('min_volume')->nullable();;
                $table->integer('internet_volume_mb')->nullable();;
                $table->string('validity_days')->nullable();
                $table->string('ussd')->nullable();
                $table->unsignedBigInteger('tag_category_id')->nullable();
                $table->unsignedBigInteger('sim_category_id');
                $table->unsignedBigInteger('offer_category_id');
        */

        $countHomePageOffer = 0;

        for ($i = 0; $i < 20; $i++) {
            $offer = OfferCategory::whereIn('alias', ['internet','pacakages','others'])->inRandomOrder()->first();
            $offerInfo = $this->getOfferInfo($offer->alias);

            $showInHome = $this->showInHome($offer->alias);
            $displayOrder = $showInHome ? ++$countHomePageOffer : 0;

            factory(Product::class)->create(
                [
                    'code' => 'ABC' . $i,
                    'name' => 'ABC' . $i,
                    'price_tk' => rand(10, 100),
                    'internet_volume_mb' =>  $offerInfo->internet_volume_mb ?? null,
                    'ussd' => '*' . rand(1000, 9999) . '*' . '1#',
                    'sim_category_id' => SimCategory::where('alias', 'postpaid')->first('id'),
                    'offer_category_id' => $offer->id,
                    'show_in_home' => $showInHome,
                    'display_order' => $displayOrder
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
                    'name' => 'ABC' . $i,
                    'price_tk' => rand(10, 100),
                    'sms_volume' => $offerInfo->sms_volume ?? null,
                    'min_volume' => $offerInfo->min_volume ?? null,
                    'internet_volume_mb' =>  $offerInfo->internet_volume_mb ?? null,
                    'validity_days' => rand(1, 10),
                    'ussd' => '*' . rand(1000, 9999) . '*' . '1#',
                    'sim_category_id' => SimCategory::where('alias', 'prepaid')->first('id'),
                    'offer_category_id' => $offer->id,
                    'show_in_home' => $showInHome,
                    'display_order' => $displayOrder
                ]
            );
        }
    }
}
