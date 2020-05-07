<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSlabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_price_slabs')->truncate();

        $slabs = [
            [
                'range_name' => '1-13tk',
                'range_start' => 1,
                'range_end' => 13,
                'product_code' => 'TK13EV50MB4D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '14-17tk',
                'range_start' => 14,
                'range_end' => 17,
                'product_code' => 'TK17EV200MB3D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '18-26tk',
                'range_start' => 18,
                'range_end' => 26,
                'product_code' => 'TK26EV150MB7D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '27-36tk',
                'range_start' => 27,
                'range_end' => 36,
                'product_code' => 'TK36EV1GB4D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '37-49tk',
                'range_start' => 37,
                'range_end' => 49,
                'product_code' => 'TK49EV2GB4D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '50-58tk',
                'range_start' => 50,
                'range_end' => 58,
                'product_code' => 'TK59PP47P7D1SEC',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '59-76tk',
                'range_start' => 59,
                'range_end' => 76,
                'product_code' => 'TK76EV1GB7D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '77-108tk',
                'range_start' => 77,
                'range_end' => 108,
                'product_code' => 'TK108EV4GB7D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '109-129tk',
                'range_start' => 109,
                'range_end' => 129,
                'product_code' => 'TK129EV6GB7D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '130-159tk',
                'range_start' => 130,
                'range_end' => 159,
                'product_code' => 'TK159PP47P30D1SEC',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '160-209tk',
                'range_start' => 160,
                'range_end' => 209,
                'product_code' => 'TK209EV2GB30D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '210-249tk',
                'range_start' => 210,
                'range_end' => 249,
                'product_code' => 'TK249EV3GB30D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '250-399tk',
                'range_start' => 250,
                'range_end' => 399,
                'product_code' => 'TK399EV5GB30D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '400-499tk',
                'range_start' => 400,
                'range_end' => 499,
                'product_code' => 'TK499EV7GB30D',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ];
        DB::table('product_price_slabs')->insert($slabs);
    }
}
