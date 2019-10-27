<?php

use Illuminate\Database\Seeder;

class ShortcutsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shortcuts')->delete();
        
        \DB::table('shortcuts')->insert(array (
            0 =>
            array (
                'id' => 34,
                'title' => 'Net Pack',
                'icon' => 'storage/short_cuts_icon/jGGf0pQdjbdtajT5kYqdWT77C7jcPs0NpvI0DPEj.png',
                'is_default' => 0,
                'component_identifier' => 'net_pack',
                'created_at' => '2019-08-21 11:45:41',
                'updated_at' => '2019-08-21 11:45:41',
            ),
            1 =>
            array (
                'id' => 35,
                'title' => 'FNF',
                'icon' => 'storage/short_cuts_icon/15iVkuQpE44g6ACWVa4XJz8QxPbYBddvrWOfClOv.jpeg',
                'component_identifier' => 'fnf',
                'is_default' => 0,
                'created_at' => '2019-08-21 11:45:59',
                'updated_at' => '2019-08-21 11:45:59',
            ),
            2 =>
            array (
                'id' => 36,
                'title' => 'Recharge',
                'icon' => 'storage/short_cuts_icon/vZz8ptMGvxj2ykgGuZo1kaNKKD1boGZ1EbN389V4.png',
                'component_identifier' => 'recharge',
                'is_default' => 1,
                'created_at' => '2019-08-21 11:46:19',
                'updated_at' => '2019-08-21 11:46:19',
            ),
            3 =>
            array (
                'id' => 37,
                'title' => 'Balance',
                'icon' => 'storage/short_cuts_icon/eRpPZi0SltbjzSMWeSwuu7W3EqKr2QCe6QGQ8Ru7.jpeg',
                'component_identifier' => 'balence',
                'is_default' => 1,
                'created_at' => '2019-08-21 11:46:32',
                'updated_at' => '2019-08-21 11:46:32',
            ),
            4 =>
            array (
                'id' => 38,
                'title' => 'Transfer',
                'icon' => 'storage/short_cuts_icon/xDzUPbOZavZjlB3KcbFLGJgXJqaNR34IxO9fl8In.jpeg',
                'component_identifier' => 'transfer',
                'is_default' => 0,
                'created_at' => '2019-08-21 11:46:47',
                'updated_at' => '2019-08-21 11:46:47',
            ),
            5 =>
            array (
                'id' => 39,
                'title' => 'Shopping',
                'icon' => 'storage/short_cuts_icon/w9vnVDPvcuJz8yBrBchvitjO8TX8yhLZT5QqHjmH.jpeg',
                'component_identifier' => 'shopping',
                'is_default' => 0,
                'created_at' => '2019-08-21 11:47:30',
                'updated_at' => '2019-08-21 11:47:30',
            ),

            6 =>
                array (
                    'id' => 40,
                    'title' => 'Bundles',
                    'icon' => 'storage/short_cuts_icon/w9vnVDPvcuJz8yBrBchvitjO8TX8yhLZT5QqHjmH.jpeg',
                    'component_identifier' => 'bundles',
                    'is_default' => 1,
                    'created_at' => '2019-08-21 11:47:30',
                    'updated_at' => '2019-08-21 11:47:30',
                ),

            7 =>
                array (
                    'id' => 41,
                    'title' => 'Amar Offer',
                    'icon' => 'storage/short_cuts_icon/w9vnVDPvcuJz8yBrBchvitjO8TX8yhLZT5QqHjmH.jpeg',
                    'component_identifier' => 'amar_offer',
                    'is_default' => 1,
                    'created_at' => '2019-08-21 11:47:30',
                    'updated_at' => '2019-08-21 11:47:30',
                ),

            8 =>
                array (
                    'id' => 42,
                    'title' => 'Packages',
                    'icon' => 'storage/short_cuts_icon/w9vnVDPvcuJz8yBrBchvitjO8TX8yhLZT5QqHjmH.jpeg',
                    'component_identifier' => 'packages',
                    'is_default' => 1,
                    'created_at' => '2019-08-21 11:47:30',
                    'updated_at' => '2019-08-21 11:47:30',
                ),
        ));
    }
}
