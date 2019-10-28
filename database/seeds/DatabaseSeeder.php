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

        $this->call(AmarOfferSeeder::class);

        // ====Common Seeder====
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // ====Asset-Lite Seeder====
        $this->call(PermissionTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CampaignTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(FooterMenuSeeder::class);
        $this->call(QuickLaunchItemSeeder::class);
        $this->call(ConfigTableSeeder::class);
        $this->call(SliderComponentTypesTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(SliderImageTableSeeder::class);
//        $this->call(DigitalServiceTableSeeder::class);
        $this->call(PartnerCategoryTableSeeder::class);
        $this->call(PartnerTableSeeder::class);
        $this->call(PartnerOfferTableSeeder::class);
        $this->call(ShortCodesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(TagCategoryTableSeeder::class);
        $this->call(SimCategoryTableSeeder::class);
        $this->call(OfferCategoryTableSeeder::class);
        $this->call(DurationCategoryTableSeeder::class);
        $this->call(ProductsTableSeeder::class);



        // ====My-Bl Seeder====
        $this->call(NotificationsDraftTableSeeder::class);
        $this->call(AmarOfferSeeder::class);
        $this->call(SettingKeysTableSeeder::class);
        $this->call(InternetOfferSeeder::class);
        $this->call(MixedBundleOfferSeeder::class);
        // $this->call(NearbyOfferSeeder::class);
        $this->call(WelcomeInfoSeeder::class);
        // $this->call(BannersTableSeeder::class);
        $this->call(CurrentBalanceSeeder::class);
        $this->call(BonusTableSeeder::class);
        $this->call(ContextualCardSeeder::class);
        $this->call(NotificationsDraftTableSeeder::class);
        $this->call(SettingKeysTableSeeder::class);
        $this->call(MyblSliderComponentTypesTableSeeder::class);
        $this->call(OfferFilterTypeTableSeeder::class);
        $this->call(NotificationUserTableSeeder::class);
        $this->call(InternetPackFilterSeeder::class);
        $this->call(MixedBundleOfferFilterSeeder::class);
        $this->call(TermsConditionsSeeder::class);
        $this->call(FaqCategorySeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(MyBlSliderSeeder::class);
        $this->call(ShortcutSeeder::class);
    }
}
