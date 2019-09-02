<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CampaignTableSeeder::class);
        $this->call(SliderTypeSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(SliderImageTableSeeder::class);
        $this->call(DigitalServiceTableSeeder::class);
        $this->call(MenusTableSeeder::class);
    }
}
