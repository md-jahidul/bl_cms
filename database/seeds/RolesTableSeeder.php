<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
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
        DB::statement("SET FOREIGN_KEY_CHECKS =0;");
        DB::table('roles')->truncate();
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
            ],
            [
                'name' => 'Lead Super Admin',
                'alias' => 'lead_super_admin',
                'user_type' => 'assetlite',
                'feature_type' => 'lead_user_role',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Lead Admin',
                'alias' => 'lead_admin',
                'user_type' => 'assetlite',
                'feature_type' => 'lead_user_role',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Lead POC',
                'alias' => 'lead_poc',
                'user_type' => 'assetlite',
                'feature_type' => 'lead_user_role',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Lead User',
                'alias' => 'lead_user',
                'user_type' => 'assetlite',
                'feature_type' => 'lead_user_role',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
