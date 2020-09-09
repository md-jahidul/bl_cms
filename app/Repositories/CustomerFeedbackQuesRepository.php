<?php

/**
 * Created by Bulbul Mahmud Nito.
 * Date: 16/07/2020
 */

namespace App\Repositories;

use App\Models\CustomerFeedback;
use App\Models\CustomerFeedbackQuestions;

class CustomerFeedbackQuesRepository extends BaseRepository
{
    public $modelName = CustomerFeedbackQuestions::class;

    public function getQuestions()
    {
        return CustomerFeedbackQuestions::orderBy('sort')->get();
    }

    public function getQuestionData($questionId)
    {
        return CustomerFeedbackQuestions::findOrFail($questionId);
    }


    public function saveQuestion($request)
    {
        $type = 2;
        $ansEn = "";
        $ansBn = "";
        if ($request->type) {
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
            'status' => $request->status,
        );
        if ($request->question_id) {
            CustomerFeedbackQuestions::where('id', $request->question_id)->update($insertdata);
        } else {
            return CustomerFeedbackQuestions::insert($insertdata);
        }
    }

    public function tableSort($request)
    {
        $positions = $request->position;
            foreach ($positions as $position) {
                $menu_id = $position[0];
                $new_position = $position[1];
                $update_menu = $this->model->findOrFail($menu_id);
                $update_menu['sort'] = $new_position;
                $update_menu->update();
            }
        return "success";
    }
}
