<?php

use Illuminate\Database\Seeder;

class SearchSettingSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('search_setting')->truncate();

        DB::table('search_setting')->insert(
                array(
                    0 =>
                    array(
                        'type' => "Prepaid Internet",
                        'type_slug' => "prepaid-internet",
                        'limit' => 3,
                    ),
                    1 =>
                    array(
                        'type' => "Prepaid Voice",
                        'type_slug' => "prepaid-voice",
                        'limit' => 3,
                    ),
                    2 =>
                    array(
                        'type' => "Prepaid Bundle",
                        'type_slug' => "prepaid-bundle",
                        'limit' => 3,
                    ),
                    3 =>
                    array(
                        'type' => "Postpaid Internet",
                        'type_slug' => "postpaid-internet",
                        'limit' => 3,
                    ),
                    4 =>
                    array(
                        'type' => "Others",
                        'type_slug' => "others",
                        'limit' => 3,
                    ),
                    5 =>
                    array(
                        'type' => "Popular Search",
                        'type_slug' => "popular-search",
                        'limit' => 3,
                    ),
        ));
    }

}
