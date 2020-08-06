<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictThanaSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distrcit = [
            [
                'id' => 1,
                'name_en' => 'Bagherhat',
            ],
            [
                'id' => 2,
                'name_en' => 'Brahmanbaria',
            ],
            [
                'id' => 3,
                'name_en' => 'Cox’s Bazar',
            ],
        ];

        $thana = [
            [
                'id' => 1,
                'district_id' => 1,
                'name_en' => 'Bagerhat Sadar',
            ],
            [
                'id' => 2,
                'district_id' => 1,
                'name_en' => 'Mongla',
            ],
            [
                'id' => 3,
                'district_id' => 2,
                'name_en' => 'Brahamanbaria Sadar',
            ],
            [
                'id' => 4,
                'district_id' => 2,
                'name_en' => 'Kasba',
            ],
            [
                'id' => 5,
                'district_id' => 3,
                'name_en' => 'CHAKARIA',
            ],
            [
                'id' => 6,
                'district_id' => 3,
                'name_en' => 'Coxs Bazar Sadar',
            ],

        ];

        DB::table('districts')->insert($distrcit);
        DB::table('thanas')->insert($thana);
    }
}
