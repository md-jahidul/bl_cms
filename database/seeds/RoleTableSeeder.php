<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('roles')->insert([
            'name' => 'admin-All',
            'description' => ''
        ]);
        DB::table('roles')->insert([
            'name' => 'admin-MyBl',
            'description' => ''
        ]);
        DB::table('roles')->insert([
            'name' => 'admin-Web',
            'description' => ''
        ]);
    }
}
