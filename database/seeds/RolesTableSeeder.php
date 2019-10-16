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
                'alias' => 'mybl-admin',
                'user_type' => 'mybl',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Guest 2',
                'alias' => 'guest2',
                'user_type' => 'mybl',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],

            [
                'name' => 'Asset Lite Admin',
                'alias' => 'asset-lite',
                'user_type' => 'mybl',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Guest 1',
                'alias' => 'guest1',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],

        ];
        DB::table('roles')->insert($roles);
    }
}
