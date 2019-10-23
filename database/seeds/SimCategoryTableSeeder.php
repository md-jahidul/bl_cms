<?php

use Illuminate\Database\Seeder;
use App\Models\SimCategory;

class SimCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sims = ['Prepaid','Postpaid','Propaid'];
        foreach ($sims as $sim) {
            factory(SimCategory::class)->create(
                [
                    'name' => $sim,
                    'alias' => strtolower(str_replace(' ', '_', $sim))
                ]
            );
        }
    }
}
