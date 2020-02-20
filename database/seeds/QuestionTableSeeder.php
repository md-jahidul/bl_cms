<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use Faker\Factory;
use \App\Tag;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        $tag = Tag::all();
//        for ($i = 0; $i < $limit; $i++) {
//            DB::table('questions')->insert([
//                'tag_id' => function () {
//                    return (App\Tag::class)->create()->id;
//                },
//                'question_text' => $faker->sentence,
//                'point' => $faker->randomDigit(),
//                'created_at' => \Carbon\Carbon::now(),
//                'updated_at' => \Carbon\Carbon::now()
//            ]);
//        }



        factory('App\Question', 10)->create();
    }
}
