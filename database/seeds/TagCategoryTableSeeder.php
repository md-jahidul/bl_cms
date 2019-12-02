<?php

use Illuminate\Database\Seeder;
use App\Models\TagCategory;

class TagCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsEn = ['Best Offer','Hot Offer','Eid Offer', 'Most Popular'];
        $tagsBn = ['সেরা অফার', 'হট অফার', 'ঈদ অফার', 'সবচেয়ে জনপ্রিয়'];
        foreach ($tagsEn as $key=>$tag)
        {
            factory(TagCategory::class)->create(
                [
                    'name_en' => $tag,
                    'name_bn' => $tagsBn[$key],
                    'alias' => strtolower(str_replace(' ', '_', $tag))
                ]
            );
        }
    }
}
