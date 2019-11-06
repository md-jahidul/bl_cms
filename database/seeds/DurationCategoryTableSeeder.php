<?php

use Illuminate\Database\Seeder;
use App\Models\DurationCategory;

class DurationCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $durations = [
            1 => 'Daily',
            3 => '3 Days',
            4 => '4 Days',
            5 => '5 Days',
            7 => 'Weekly',
            15 => 'Bi weekly',
            30 => 'Monthly'
        ];

        $durationsBn = ['দৈনিক', '৩ দিন', '৪ দিন', '৫ দিন', 'সাপ্তাহিক', 'দ্বি সাপ্তাহিক', 'মাসিক'];

        $i = 0;
        foreach ($durations as $key => $value) {
            factory(DurationCategory::class)->create(
                [
                    'name_en' => $value,
                    'name_bn' => $durationsBn[$i++],
                    'alias' => strtolower(str_replace(' ', '_', $value)),
                    'days' => $key
                ]
            );
        }
    }
}
