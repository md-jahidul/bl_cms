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
                "range_name" => "18-23tk",
                "range_start" => "18",
                "range_end" => "23",
                "product_code" => "TK26EV150MB7D"
            ],
            [
                "range_name" => "24-27tk",
                "range_start" => "24",
                "range_end" => "27",
                "product_code" => "TK27EV45MIN3D"
            ],
            [
                "range_name" => "28-29tk",
                "range_start" => "28",
                "range_end" => "29",
                "product_code" => "TK29PP60P3D1SEC"
            ],
            [
                "range_name" => "30-36tk",
                "range_start" => "30",
                "range_end" => "36",
                "product_code" => "TK38BTL7DEVMIXED"
            ],
            [
                "range_name" => "37-41tk",
                "range_start" => "37",
                "range_end" => "41",
                "product_code" => "TK41USSD1GB4D"
            ],
            [
                "range_name" => "42-53tk",
                "range_start" => "42",
                "range_end" => "53",
                "product_code" => "TK57EV99MIN7D"
            ],
            [
                "range_name" => "54-57tk",
                "range_start" => "54",
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
                "range_name" => "60-64tk",
                "range_start" => "60",
                "range_end" => "64",
                "product_code" => "TK64USSD3GB4D"
            ],
            [
                "range_name" => "65-88tk",
                "range_start" => "65",
                "range_end" => "88",
                "product_code" => "TK88EV7DMIX"
            ],
            [
                "range_name" => "89-100tk",
                "range_start" => "89",
                "range_end" => "100",
                "product_code" => "TK107EV175MIN7D"
            ],
            [
                "range_name" => "101-108tk",
                "range_start" => "101",
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
                "range_name" => "140-147tk",
                "range_start" => "140",
                "range_end" => "147",
                "product_code" => "TK149EV8GB7D"
            ],
            [
                "range_name" => "148-157tk",
                "range_start" => "148",
                "range_end" => "157",
                "product_code" => "TK157EV250MIN30D"
            ],
            [
                "range_name" => "158-159tk",
                "range_start" => "158",
                "range_end" => "159",
                "product_code" => "TK159PP47P30D1SEC"
            ],
            [
                "range_name" => "160-169Tk",
                "range_start" => "160",
                "range_end" => "169",
                "product_code" => "TK169USSD10GB7D"
            ],
            [
                "range_name" => "170-180tk",
                "range_start" => "170",
                "range_end" => "180",
                "product_code" => "TK197EV340MIN30D"
            ],
            [
                "range_name" => "181-193tk",
                "range_start" => "181",
                "range_end" => "193",
                "product_code" => "TK199EV10GB7D"
            ],
            [
                "range_name" => "194-202tk",
                "range_start" => "194",
                "range_end" => "202",
                "product_code" => "TK207EV340MIN30D"
            ],
            [
                "range_name" => "203-209tk",
                "range_start" => "203",
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
                "range_name" => "280-294tk",
                "range_start" => "280",
                "range_end" => "294",
                "product_code" => "TK299EV6GB30D"
            ],
            [
                "range_name" => "295-307tk",
                "range_start" => "295",
                "range_end" => "307",
                "product_code" => "TK307EV510MIN30D"
            ],
            [
                "range_name" => "308-399tk",
                "range_start" => "308",
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

        DB::table('product_price_slabs')->insert($slabs);
    }
}
