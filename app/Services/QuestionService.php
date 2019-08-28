<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 28-Aug-19
 * Time: 12:57 PM
 */

namespace App\Services;


use App\Repositories\QuestionRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class QuestionService
{
    use CrudTrait;

    protected $questionService;

    /**
     * QuestionService constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionService = $questionRepository;
        $this->setActionRepository($questionRepository);
    }

    public function storeQuestion($data)
    {

        echo "<pre>";
        print_r($data);die();

        $question_data = $data->only('question_text', 'point', 'tag_id');
        $option_data = $request->only('option');
        $option_count = count($option_data['option']);
        $answer_data = $request->only('answer');

        $answer_array = [];
        for($i=1; $i <= $option_count; $i++){
            $ans =  (int) $answer_data['answer'][0];
            $answer_array[] = ( $i != $ans ) ? false : true;
        }

        if (!empty($question_data)){
            $question = Question::create($question_data);
        }
        if (!empty($option_data)){
            for ($i = 0; $i<$option_count; $i++){
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $option_data['option'][$i],
                    'is_correct' => $answer_array[$i]
                ]);
            }
            return redirect()->back();
        }
        return new Response('Question added successfully');
    }
}