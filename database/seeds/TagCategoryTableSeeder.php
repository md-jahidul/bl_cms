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
        $tags = ['Best Offer','Hot Offer','Eid Offer'];
        foreach ($tags as $tag) {
            factory(TagCategory::class)->create(
                [
                    'name' => $tag,
                    'alias' => strtolower(str_replace(' ', '_', $tag))
                ]
            );
        }
    }
}
