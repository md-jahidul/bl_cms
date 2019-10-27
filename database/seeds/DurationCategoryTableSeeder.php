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
        $durations = ['Days','Weekly','Bi weekly','Monthly'];
        foreach ($durations as $duration) {
            factory(DurationCategory::class)->create(
                [
                    'name' => $duration,
                    'alias' => strtolower(str_replace(' ', '_', $duration))
                ]
            );
        }
    }
}
