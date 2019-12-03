<?php

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TelescopepanelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('email', 'admin@telescope.com')->first()->delete();
        $user = User::create([
            'name' => 'Telescope user',
            'email' => 'admin@telescope.com',
            'type' => 'mybl',
            'phone' => '',
            'uid' => uniqid(),
            'password' => Hash::make('123456'),
            'device_token' => ''
        ]);

        RoleUser::insert([
            'role_id' => 1,
            'user_id' => $user->id
        ]);
    }
}
