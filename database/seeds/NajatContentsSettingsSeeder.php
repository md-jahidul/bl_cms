<?php

use Illuminate\Database\Seeder;

class NajatContentsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = [
            [
                'key' => \App\Enums\MyBlAppSettingsKey::NAJAT_CONTENTS_SETTINGS,
                'value' => json_encode(
                    [
                        'enable'              => false,
                        'show_in_home'        => false,
                        'eid_banner_duration' => 1,
                    ]
                ),
            ]
        ];

        foreach ($keys as $key) {
            \App\Models\MyBlAppSettings::create($key);
        }
    }
}
