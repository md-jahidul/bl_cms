<?php

use App\Models\MyBlLearnPriyojonContent;
use Illuminate\Database\Seeder;

/**
 * Class MyblPriyojonLearnContentSeeder
 */
class MyblPriyojonLearnContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = view('admin.learn-priyojon.default-content')->render();

        MyBlLearnPriyojonContent::updateOrCreate(
            [
                'platform' => 'app'
            ],
            [
                'contents' => $contents
            ]
        );
    }
}
