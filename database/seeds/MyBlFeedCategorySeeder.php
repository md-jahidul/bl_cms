<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class MyBlFeedCategorySeeder
 */
class MyBlFeedCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_bl_feed_categories')->truncate();

        $categories = [
            [
                'title'    => 'All',
                'ordering' => 1,
            ],
            [
                'title'    => 'News',
                'ordering' => 2,
            ],
            [
                'title'    => 'Health',
                'ordering' => 3,
            ],
            [
                'title'    => 'Sports',
                'ordering' => 4,
            ],
            [
                'title'    => 'Entertainment',
                'ordering' => 5,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\MyBlFeedCategory::create($category);
        }
    }
}
