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
<<<<<<< HEAD
//      Common Seeder
=======
        $this->call(NotificationsTableSeeder::class);
        $this->call(AmarOfferSeeder::class);
>>>>>>> bc00a04cdad526eafd2147e8bb1f3affaa2f4b6f
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);

//      Asset-Lite Seeder
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
<<<<<<< HEAD
        $this->call(PartnerCategoryTableSeeder::class);
=======
        $this->call(SettingKeysTableSeeder::class);
        $this->call(OfferFilterTypeTableSeeder::class);
>>>>>>> bc00a04cdad526eafd2147e8bb1f3affaa2f4b6f

//      My-Bl Seeder
        $this->call(AmarOfferSeeder::class);
        $this->call(SettingKeysTableSeeder::class);
        $this->call(InternetOfferSeeder::class);
        $this->call(MixedBundleOfferSeeder::class);
        $this->call(NearbyOfferSeeder::class);
        $this->call(WelcomeInfoSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(CurrentBalanceSeeder::class);
        $this->call(BonusTableSeeder::class);
        $this->call(ContextualCardSeeder::class);
<<<<<<< HEAD
        $this->call(MyblSliderComponentTypesTableSeeder::class);
=======

>>>>>>> bc00a04cdad526eafd2147e8bb1f3affaa2f4b6f
    }
}
