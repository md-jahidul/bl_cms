<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class MyBlAppSettingsSeeder
 */
class MyBlAppSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_bl_app_settings')->truncate();

        $keys = [
            [
                'key' => \App\Enums\MyBlAppSettingsKey::LOAN_ELIGIBILITY_MIN_AMOUNT,
                'value' => json_encode([
                    'value' => 10
                ]),
            ]
        ];

        foreach ($keys as $key) {
            \App\Models\MyBlAppSettings::create($key);
        }
    }
}
