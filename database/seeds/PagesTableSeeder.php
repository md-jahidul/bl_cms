<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

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
            Page::create([
                'title' => $page, 
                'menu_id' => $page_id, 
                'meta_tag_id' => $page_id,
                'page_type' => 'fixed'
            ]);
        }       
    }
}
