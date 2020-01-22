<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class FeedCategorySeeder
 */
class FeedCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first truncate table
        DB::table('feed_categories')->truncate();
        $category = [
            [
                'title' => 'Trending',
                'sort'  =>  1 ,
            ],
            [
                'title' => 'Lifestyle',
                'sort'  =>  2 ,
            ],
            [
                'title' => 'Tech',
                'sort'  =>  3 ,
            ],
            [
                'title' => 'Fashion',
                'sort'  =>  4
            ],
        ];

        foreach ($category as $data) {
            \App\Models\FeedCategory::create($data);
        }
    }
}
