<?php

use App\Models\BanglalinkThreeG;
use Illuminate\Database\Seeder;

class ThreeGLandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banglalink_three_g_s')->truncate();

        BanglalinkThreeG::create([
            'title_en' => "Title En",
            'title_bn' => "Title En",
            'description_en' => "Description English",
            'description_bn' => "Description Bangla",
            'type' => "title_with_text",
            'status' => 1,
        ]);
    }
}
