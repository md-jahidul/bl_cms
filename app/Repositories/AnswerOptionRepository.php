<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 29-Aug-19
 * Time: 12:20 PM
 */

namespace App\Repositories;


use App\Models\AnswerOption;

class AnswerOptionRepository extends BaseRepository
{
    public $modelName = AnswerOption::class;

    /**
     * @param $request
     * @param $questionId
     */
    public function optionAnswerCreate($request, $questionId)
    {
        $option_data = $request->only('option');
        $option_count = count($option_data['option']);
        $answer_data = $request->only('answer');

        $answer_array = [];
        for($i=1; $i <= $option_count; $i++){
            $ans =  (int) $answer_data['answer'][0];
            $answer_array[] = ( $i != $ans ) ? false : true;
        }
        if (!empty($option_data)){
            for ($i = 0; $i<$option_count; $i++){
                $this->model->create([
                    'question_id' => $questionId,
                    'option_text' => $option_data['option'][$i],
                    'is_correct' => $answer_array[$i]
                ]);
            }
        }
    }

    public function updateOptionAnswer($data, $id)
    {
        $option_data = $data->only('option');
        $option_count = count($option_data['option']);
        $answer_data = $data->only('answer');
        $options = $this->model->where('question_id', $id)->get();

        $answer_array = [];
        for($i=1; $i <= $option_count; $i++){
            $ans =  (int) $answer_data['answer'][0];
            $answer_array[] = ( $i != $ans ) ? false : true;
        }

        foreach ($options as $key=>$option){
            $option->update([
                'question_id' => $id,
                'option_text' => $option_data['option'][$key],
                'is_correct' => $answer_array[$key]
            ]);
        }

    }
}
