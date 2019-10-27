<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShortcutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('shortcuts')->truncate();
            $slider_data = [
                [
                    'title ' => 'Recharge',
                    'icon '  => 'seeder-images/recharge.png',
                    'component_identifier '  => 'recharge',
                    'is_default' => 1,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ],
                [
                    'title ' => 'Package',
                    'icon '  => 'seeder-images/package.png',
                    'component_identifier '  => 'package',
                    'is_default' => 0,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ],
                [
                'title ' => 'Amar Offer',
                'icon '  => 'seeder-images/amar-offer.png',
                'component_identifier '  => 'amar_offer',
                'is_default' => 0,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]
            ];

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
