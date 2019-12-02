<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\MetaTag;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $fixedPages = ['Home','Offers'];

        foreach ($fixedPages as $key => $page) {
            $page_id = $key + 1;
            
            MetaTag::create([
                'title' => $page,
                'keywords' => $page,
                'description' => null,
                'page_id' => $page_id
            ]);

            Page::create([
                'title' => $page,
                'menu_id' => $page_id,
                'page_type' => 'fixed'
            ]);
        }
    }
}
