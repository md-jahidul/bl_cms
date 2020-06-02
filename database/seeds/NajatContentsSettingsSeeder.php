<?php

use Illuminate\Database\Seeder;

/**
 * Class NajatContentsSettingsSeeder
 */
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
                        'is_enable'             => false,
                        'show_in_home'          => false,
                        'show_banner'           => false,
                        'show_download_link'    => false,
                        'show_iftar_sehri_time' => false,
                        'show_namaj_time'       => false,
                    ]
                ),
            ]
        ];

        foreach ($keys as $key) {
            \App\Models\MyBlAppSettings::updateOrCreate(['key' => $key['key']], ['value' => $key['value']]);
        }
    }
}
