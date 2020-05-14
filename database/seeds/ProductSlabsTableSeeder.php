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
                "range_name" => "1-14tk",
                "range_start" => "1",
                "range_end" => "14",
                "product_code" => "TK14EV24MIN2D"
            ],
            [
                "range_name" => "15-17tk",
                "range_start" => "15",
                "range_end" => "17",
                "product_code" => "TK17EV200MB3D"
            ],
            [
                "range_name" => "18-26tk",
                "range_start" => "18",
                "range_end" => "26",
                "product_code" => "TK26EV150MB7D"
            ],
            [
                "range_name" => "27-29tk",
                "range_start" => "27",
                "range_end" => "29",
                "product_code" => "TK29PP60P3D1SEC"
            ],
            [
                "range_name" => "30-36tk",
                "range_start" => "30",
                "range_end" => "36",
                "product_code" => "TK36EV1GB4D"
            ],
            [
                "range_name" => "37-38tk",
                "range_start" => "37",
                "range_end" => "38",
                "product_code" => "TK38BTL7DEVMIXED"
            ],
            [
                "range_name" => "39-44tk",
                "range_start" => "39",
                "range_end" => "44",
                "product_code" => "TK47EV80MIN7D"
            ],
            [
                "range_name" => "45-49tk",
                "range_start" => "45",
                "range_end" => "49",
                "product_code" => "TK49EV2GB4D"
            ],
            [
                "range_name" => "50-54tk",
                "range_start" => "50",
                "range_end" => "54",
                "product_code" => "TK57EV99MIN7D"
            ],
            [
                "range_name" => "55-57tk",
                "range_start" => "55",
                "range_end" => "57",
                "product_code" => "TK58EV4GB4D"
            ],
            [
                "range_name" => "58-59tk",
                "range_start" => "58",
                "range_end" => "59",
                "product_code" => "TK59PP47P7D1SEC"
            ],
            [
                "range_name" => "60-88tk",
                "range_start" => "60",
                "range_end" => "88",
                "product_code" => "TK88EV7DMIX"
            ],
            [
                "range_name" => "89-97tk",
                "range_start" => "89",
                "range_end" => "97",
                "product_code" => "TK97EV165MIN15D"
            ],
            [
                "range_name" => "98-108tk",
                "range_start" => "98",
                "range_end" => "108",
                "product_code" => "TK108EV4GB7D"
            ],
            [
                "range_name" => "109-129tk",
                "range_start" => "109",
                "range_end" => "129",
                "product_code" => "TK129EV6GB7D"
            ],
            [
                "range_name" => "130-139tk",
                "range_start" => "130",
                "range_end" => "139",
                "product_code" => "TK147EV250MIN30D"
            ],
            [
                "range_name" => "140-149tk",
                "range_start" => "140",
                "range_end" => "149",
                "product_code" => "TK149EV8GB7D"
            ],
            [
                "range_name" => "150-159tk",
                "range_start" => "150",
                "range_end" => "159",
                "product_code" => "TK159PP47P30D1SEC"
            ],
            [
                "range_name" => "160-189tk",
                "range_start" => "160",
                "range_end" => "189",
                "product_code" => "TK197EV340MIN30D"
            ],
            [
                "range_name" => "190-199tk",
                "range_start" => "190",
                "range_end" => "199",
                "product_code" => "TK199EV10GB7D"
            ],
            [
                "range_name" => "200-209tk",
                "range_start" => "200",
                "range_end" => "209",
                "product_code" => "TK209EV2GB30D"
            ],
            [
                "range_name" => "210-249tk",
                "range_start" => "210",
                "range_end" => "249",
                "product_code" => "TK249EV3GB30D"
            ],
            [
                "range_name" => "250-297tk",
                "range_start" => "250",
                "range_end" => "279",
                "product_code" => "TK297EV515MIN30D"
            ],
            [
                "range_name" => "280-299tk",
                "range_start" => "280",
                "range_end" => "299",
                "product_code" => "TK299EV6GB30D"
            ],
            [
                "range_name" => "300-399tk",
                "range_start" => "300",
                "range_end" => "399",
                "product_code" => "TK399EV5GB30D"
            ],
            [
                "range_name" => "400-488tk",
                "range_start" => "400",
                "range_end" => "488",
                "product_code" => "TK488EV30DMIX"
            ],
            [
                "range_name" => "489-499tk",
                "range_start" => "489",
                "range_end" => "499",
                "product_code" => "TK499EV7GB30D"
            ],
            [
                "range_name" => "500-699tk",
                "range_start" => "500",
                "range_end" => "699",
                "product_code" => "TK699EV25GB30D"
            ],
            [
                "range_name" => "700-1000tk",
                "range_start" => "700",
                "range_end" => "1000",
                "product_code" => "TK999EV50GB30D"
            ]
        ];


//        $slabs = [
//            [
//                'range_name' => '1-13tk',
//                'range_start' => 1,
//                'range_end' => 13,
//                'product_code' => 'TK13EV50MB4D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '14-17tk',
//                'range_start' => 14,
//                'range_end' => 17,
//                'product_code' => 'TK17EV200MB3D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '18-26tk',
//                'range_start' => 18,
//                'range_end' => 26,
//                'product_code' => 'TK26EV150MB7D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '27-36tk',
//                'range_start' => 27,
//                'range_end' => 36,
//                'product_code' => 'TK36EV1GB4D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '37-49tk',
//                'range_start' => 37,
//                'range_end' => 49,
//                'product_code' => 'TK49EV2GB4D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '50-58tk',
//                'range_start' => 50,
//                'range_end' => 58,
//                'product_code' => 'TK59PP47P7D1SEC',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '59-76tk',
//                'range_start' => 59,
//                'range_end' => 76,
//                'product_code' => 'TK76EV1GB7D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '77-108tk',
//                'range_start' => 77,
//                'range_end' => 108,
//                'product_code' => 'TK108EV4GB7D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '109-129tk',
//                'range_start' => 109,
//                'range_end' => 129,
//                'product_code' => 'TK129EV6GB7D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '130-159tk',
//                'range_start' => 130,
//                'range_end' => 159,
//                'product_code' => 'TK159PP47P30D1SEC',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '160-209tk',
//                'range_start' => 160,
//                'range_end' => 209,
//                'product_code' => 'TK209EV2GB30D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '210-249tk',
//                'range_start' => 210,
//                'range_end' => 249,
//                'product_code' => 'TK249EV3GB30D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '250-399tk',
//                'range_start' => 250,
//                'range_end' => 399,
//                'product_code' => 'TK399EV5GB30D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//            [
//                'range_name' => '400-499tk',
//                'range_start' => 400,
//                'range_end' => 499,
//                'product_code' => 'TK499EV7GB30D',
//                'created_at' => Carbon::now()->toDateTimeString(),
//                'updated_at' => Carbon::now()->toDateTimeString(),
//            ],
//        ];
        DB::table('product_price_slabs')->insert($slabs);
    }
}
