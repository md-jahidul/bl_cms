<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NearbyOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = [

            [
                'title' => '250MNN',
                'vendor'=> "Burger King",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Resturants",
                'offer' => "20% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(10),
                'image' =>"https://s3-ap-southeast-1.amazonaws.com/asset1.gotomalls.com/uploads/news/translation/2017/08/LPKw8ct5IM8lt_Ih-discount-20-from-burger-king-at-mall-of-indonesia-1504017451_1.jpg"
            ],

            [
                'title' => '250MNN',
                'vendor'=> "Burger King",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Resturants",
                'offer' => "15% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(15),
                'image' =>"https://www.hospitalityandcateringnews.com/wp-content/uploads/2014/09/BURGER-KING-introduces-chicken-and-burger-King-Deals.png"
            ],

            [
                'title' => '250MNN',
                'vendor'=> "Gentle Park",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Fashion",
                'offer' => "15% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(15),
                'image' =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOHqpizRVBFe6Nia7G5GyKcAf6PaA7oNufbMQt3mRTrJKYIfyzAQ"
            ],

            [
                'title' => '250MNN',
                'vendor'=> "Yellow",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Fashion",
                'offer' => "15% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(15),
                'image' =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMqWUbb9EGhG0ER2_hlM5csJR4yTZtkoKT4SMTCSuYaXVBYKa9dA"
            ],


            [
                'title' => '250MNN',
                'vendor'=> "Richman",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Fashion",
                'offer' => "15% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(15),
                'image' =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNNoFOq45Cm38SQzSZJOhgCanfpmWwNNm067yC9E_CLQEjdzLdEA"
            ],

            [
                'title' => '250MNN',
                'vendor'=> "Aroma Coffee shop",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Coffee Shop",
                'offer' => "15% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(15),
                'image' =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRskgcht7CsOBAACgWhS6s0Bx-tZ9qLODKnT9n4DK8TP-jyh9Zx"
            ],

            [
                'title' => '250MNN',
                'vendor'=> "Aroma Coffee shop",
                'location' => "Gulshan 1, Dahaka",
                'type' => "Coffee Shop",
                'offer' => "15% discount",
                'offer_code' => "NB20",
                'validity' => Carbon::now()->addDays(15),
                'image' =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRskgcht7CsOBAACgWhS6s0Bx-tZ9qLODKnT9n4DK8TP-jyh9Zx"
            ],


        ];

        DB::table('nearby_offers')->insert($offers);
    }
}

