<?php

use App\Models\MixedBundleFilter;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MixedBundleOfferFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mixed_bundle_filters')->truncate();

        $data = [
            [
                'offer_filter_type_id' => 1,
                'filter' => json_encode([
                    'unit'  => 'tk.',
                    'lower' => 0,
                    'upper' => 100,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 1,
                'filter' => json_encode([
                    'unit'  => 'tk.',
                    'lower' => 101,
                    'upper' => 250,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 1,
                'filter' => json_encode([
                    'unit'  => 'tk.',
                    'lower' => 250,
                    'upper' => null,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],

            [
                'offer_filter_type_id' => 2,
                'filter' => json_encode([
                    'unit'  => 'mb',
                    'lower' => 0,
                    'upper' => 1024,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 2,
                'filter' => json_encode([
                    'unit'  => 'mb',
                    'lower' => 1024,
                    'upper' => 1024 * 3,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 2,
                'filter' => json_encode([
                    'unit'  => 'mb',
                    'lower' => 1024 * 3,
                    'upper' => null,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],

            [
                'offer_filter_type_id' => 3,
                'filter' => json_encode([
                    'unit'  => 'minutes',
                    'lower' => 0,
                    'upper' => 250,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 3,
                'filter' => json_encode([
                    'unit'  => 'minutes',
                    'lower' => 250,
                    'upper' => null,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],


            [
                'offer_filter_type_id' => 4,
                'filter' => json_encode([
                    'unit'  => 'sms',
                    'lower' => 0,
                    'upper' => 250,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 4,
                'filter' => json_encode([
                    'unit'  => 'sms',
                    'lower' => 250,
                    'upper' => null,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],

            [
                'offer_filter_type_id' => 5,
                'filter' => json_encode([
                    'unit'  => 'days',
                    'lower' => 0,
                    'upper' => 7,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'offer_filter_type_id' => 5,
                'filter' => json_encode([
                    'unit'  => 'days',
                    'lower' => 7,
                    'upper' => null,
                ]),
                'created_at' => Carbon::now('UTC')->toDateTimeString()
            ],
        ];

        MixedBundleFilter::insert($data);
    }
}
