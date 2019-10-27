<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory('App\Option')->create();

//        $questions = \App\Question::select('id')->get();
//        $q_id = [];
//        foreach ($questions as $question){
//            array_push($q_id, $question->id);
//        }
//
//        $faker = \Faker\Factory::create();
//        $limit = 4;
//        for ($i = 0; $i < $limit; $i++) {
//            DB::table('options')->insert([
//                'question_id' => $faker->randomElement($q_id),
//                'option_id' => $i+1,
//                'option' => $faker->domainWord,
//                'created_at' => \Carbon\Carbon::now(),
//                'updated_at' => \Carbon\Carbon::now()
//            ]);
//
//            $op_id = [];
//            foreach ($questions as $question){
//                array_push($op_id, $question->id);
//            }
//
//            DB::table('answers')->insert([
//                'question_id' => $faker->randomElement($q_id),
//                'option_id' => $faker->randomElement($op_id),
//            ]);
//        }
    }
}
