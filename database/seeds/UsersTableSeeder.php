<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'admin',
            'role_id' => 1,
            'email' => 'admin@admin.com',
            'phone' => '01919111111',
            'uid' => uniqid(),
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);
    }
}
