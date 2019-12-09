<?php

use App\Models\MyBlProductCategory;
use Illuminate\Database\Seeder;

class MyBlProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MyBlProductCategory::create([
            'name' => 'Internet'
        ]);

        MyBlProductCategory::create([
            'name' => 'Voice'
        ]);

        MyBlProductCategory::create([
            'name' => 'SMS'
        ]);

        MyBlProductCategory::create([
            'name' => 'Mix'
        ]);

        MyBlProductCategory::create([
            'name' => 'Gift'
        ]);

        MyBlProductCategory::create([
            'name' => 'Loan'
        ]);
    }
}
