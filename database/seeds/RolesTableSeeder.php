<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'My Bl Admin',
                'alias' => 'mybl_admin',
                'user_type' => 'mybl',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Asset Lite Super Admin',
                'alias' => 'assetlite_super_admin',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Asset Lite Super User',
                'alias' => 'assetlite_super_user',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Asset Lite Power User',
                'alias' => 'assetlite_power_user',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Asset Lite User',
                'alias' => 'assetlite_normal_user',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('roles')->insert($roles);
    }
}
