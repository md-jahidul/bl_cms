<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banners')->delete();
        
        \DB::table('banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Net Pack',
                'code' => 'Eid_1NP',
                'redirect_url' => 'www.banglalink.com',
                'image_name' => 'New Sim Offer',
                'image_path' => 'https://alldataplan.com/wp-content/uploads/2018/10/New-SIM-Offer.jpg',
                'created_at' => '2019-09-01 04:26:50',
                'updated_at' => '2019-09-01 04:26:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Net Pack',
                'code' => 'NP-1',
                'redirect_url' => 'www.banglalink.com',
                'image_name' => 'Bando Sim Offer',
                'image_path' => 'https://gsmoffers.com/wp-content/uploads/2018/09/banglalink-bondho-sim-offer-min.jpg',
                'created_at' => '2019-09-01 04:27:28',
                'updated_at' => '2019-09-01 04:27:28',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'SMS Bundle',
                'code' => 'SMS',
                'redirect_url' => 'www.banglalink.com',
                'image_name' => 'SMS',
                'image_path' => 'storage/banner/9v9HRF6nFOu3oPxjlXDUKIWEDrmyU3jAhQJtgQrV.png',
                'created_at' => '2019-09-01 04:28:02',
                'updated_at' => '2019-09-01 04:28:02',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Talk Time',
                'code' => 'TT-1',
                'redirect_url' => 'www.banglalink.com',
                'image_name' => 'Talk TIme',
                'image_path' => 'storage/banner/XJxOejVQINmrOZ7ka4REdZ4Er6oWXzPcOmVsRbuN.jpeg',
                'created_at' => '2019-09-01 04:28:42',
                'updated_at' => '2019-09-01 04:28:42',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'World Cup',
                'code' => 'WC',
                'redirect_url' => 'www.banglalink.com',
                'image_name' => 'WC',
                'image_path' => 'storage/banner/mHdXl4w4r0B1y662u3riQVpqECiy0KZh3TJnWmb5.png',
                'created_at' => '2019-09-01 04:29:36',
                'updated_at' => '2019-09-01 04:29:36',
            ),
        ));
        
        
    }
}