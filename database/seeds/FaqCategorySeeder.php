<?php

use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'title' => 'Category 1',
                'slug' => 'category_1',
                'platform' => 'app',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Category 2',
                'slug' => 'category_2',
                'platform' => 'app',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Category 3',
                'slug' => 'category_3',
                'platform' => 'app',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
        ];

        \App\Models\FaqCategory::insert($category);
    }
}
