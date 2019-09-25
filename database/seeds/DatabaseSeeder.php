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
        $this->call(NotificationsTableSeeder::class);
        $this->call(AmarOfferSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CampaignTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(FooterMenuSeeder::class);
        $this->call(QuickLaunchItemSeeder::class);
        $this->call(ConfigTableSeeder::class);
        $this->call(SliderComponentTypesTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(SliderImageTableSeeder::class);
        $this->call(DigitalServiceTableSeeder::class);
        $this->call(SettingKeysTableSeeder::class);

        $this->call(InternetOfferSeeder::class);
        $this->call(MixedBundleOfferSeeder::class);
        $this->call(NearbyOfferSeeder::class);
        $this->call(WelcomeInfoSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(CurrentBalanceSeeder::class);
        $this->call(BonusTableSeeder::class);
        $this->call(ContextualCardSeeder::class);

    }
}
