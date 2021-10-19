<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Priyojon;
use App\Models\AboutPage;

class PriyojonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priyojons')->truncate();

        $priyojonLandingData = [
            [
                'parent_id' => 0,
                'title_en' => "Life style benefits",
                'title_bn' => "লাইফ স্টাইলের উপকার হয়",
            ],

            [
                'parent_id' => 0,
                'title_en' => "Reward Points",
                'title_bn' => "পুরস্কার পয়েন্ট",
            ]
        ];

        DB::table('priyojons')->insert($priyojonLandingData);

        $subMenuEn = ['About Priojon', 'Partners', 'Benefits',];
        $subMenuBn = ['প্রিজোন সম্পর্কে', 'অংশীদার', 'সুবিধা',];
        $lifeStyleAlias = ['about-priyojon', 'partner', 'benefit'];

        foreach ($subMenuEn as $key => $value) {
            Priyojon::create([
                'parent_id' => 1,
                'title_en' => $value,
                'title_bn' => $subMenuBn[$key],
            ]);
        }

        $subMenuEn = ['About', 'Redeem Point'];
        $subMenuBn = ['সম্পর্কে', 'রিডিম পয়েন্ট'];
        $rewardAlias = ['about', 'redeem-point'];

        foreach ($subMenuEn as $key => $value) {
            Priyojon::create([
                'parent_id' => 2,
                'title_en' => $value,
                'title_bn' => $subMenuBn[$key],
            ]);
        }
    }
}
