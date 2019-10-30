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
            7 => 'Weekly',
            15 => 'Bi weekly',
            30 => 'Monthly'
        ];

        foreach ($durations as $key => $value) {
            factory(DurationCategory::class)->create(
                [
                    'name' => $value,
                    'alias' => strtolower(str_replace(' ', '_', $value)),
                    'days' => $key
                ]
            );
        }
    }
}
