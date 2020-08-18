<?php

/**
 * Created by Bulbul Mahmud Nito.
 * Date: 16/07/2020
 */

namespace App\Repositories;

use App\Models\CustomerFeedback;
use App\Models\CustomerFeedbackQuestions;

class CustomerFeedbackRepository extends BaseRepository
{
    public $modelName = CustomerFeedback::class;
    
    public function getQuestions(){
        $questions = CustomerFeedbackQuestions::orderBy('sort')->get();
        return $questions;
    }
    
    public function getQuestionData($questionId){
        $question = CustomerFeedbackQuestions::findOrFail($questionId);
        return $question;
    }
    
    
    
    public function saveQuestion($request) {

        $type = 2;
        $ansEn = "";
        $ansBn = "";
        if($request->type){
            $type = 1;
            $ansEn = json_encode($request->inputs_en);
            $ansBn = json_encode($request->inputs_bn);
        }

        $insertdata = array(
            'question_en' => $request->question_en,
            'question_bn' => $request->question_bn,
            'answers_en' => $ansEn,
            'answers_bn' => $ansBn,
            'type' => $type,
        );


        if($request->question_id){
             CustomerFeedbackQuestions::where('id', $request->question_id)->update($insertdata);
        }else{
            return CustomerFeedbackQuestions::insert($insertdata);
        }

    }
}
