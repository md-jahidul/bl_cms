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
        $slabs = [
            [
                'range_name' => '1-10tk',
                'range_start' => 1,
                'range_end' => 10,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '11-20tk',
                'range_start' => 11,
                'range_end' => 20,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '21-50tk',
                'range_start' => 21,
                'range_end' => 50,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '51-75tk',
                'range_start' => 51,
                'range_end' => 75,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '76-100tk',
                'range_start' => 76,
                'range_end' => 100,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '101-125tk',
                'range_start' => 101,
                'range_end' => 125,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '126-150tk',
                'range_start' => 126,
                'range_end' => 150,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '151tk-200tk',
                'range_start' => 151,
                'range_end' => 200,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '201-300tk',
                'range_start' => 201,
                'range_end' => 300,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '301-400tk',
                'range_start' => 301,
                'range_end' => 400,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '401-500tk',
                'range_start' => 401,
                'range_end' => 500,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '501-600tk',
                'range_start' => 501,
                'range_end' => 600,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '601-700tk',
                'range_start' => 601,
                'range_end' => 700,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'range_name' => '700+',
                'range_start' => 701,
                'range_end' => 10000,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            
        ];
        DB::table('product_price_slabs')->insert($slabs);
    }
}
