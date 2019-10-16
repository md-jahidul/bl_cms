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
                'name' => 'Asset Lite Admin',
                'alias' => 'asset-lite',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'User Management',
                'alias' => 'user_management',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Editor',
                'alias' => 'editor',
                'user_type' => 'assetlite',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        DB::table('roles')->insert($roles);
    }
}
