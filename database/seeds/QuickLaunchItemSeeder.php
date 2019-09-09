<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuickLaunchItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $quick_launch_items = [];
        $items = ["New connection","Packages","Roaming", "Digital Services","Helpline","My BL AppHelpline","Bondho SIM Offer","Banglalink Advancee","Shop","Lifestyle & Benefits","Banglalink 4G"];

        foreach ($items as $key => $item) {
            $quick_launch_items[] = [
                'title' => $item,
                'image_url' => env('APP_URL', 'http://localhost:8000') . '/quick-launch-items/' . strtolower( str_replace( " ", "-", $item) ) . '.png',
                'alt_text' => $item,
                'link' => 'http://103.4.146.91:89/assetlite-cms/' . strtolower( str_replace( " ", "-", $item) ),
                'display_order' => ++$key,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }

        DB::table('quick_launch_items')->insert($quick_launch_items);
    }
}
