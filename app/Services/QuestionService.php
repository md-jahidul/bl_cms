<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 28-Aug-19
 * Time: 12:57 PM
 */

namespace App\Services;


use App\Repositories\OptionRepository;
use App\Repositories\QuestionRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class QuestionService
{
    use CrudTrait;

    /**
     * @var QuestionRepository
     */
    protected $questionService;

    protected $optionService;

    /**
     * QuestionService constructor.
     * @param QuestionRepository $questionRepository
     * @param OptionRepository $optionRepository
     */
    public function __construct(QuestionRepository $questionRepository, OptionRepository $optionRepository)
    {
        $this->questionService = $questionRepository;
        $this->optionService = $optionRepository;
        $this->setActionRepository($questionRepository);
    }

    public function storeQuestion($request)
    {

        $question_data = $request->only('question_text', 'point', 'tag_id');
        $option_data = $request->only('option');
        $option_count = count($option_data['option']);
        $answer_data = $request->only('answer');

//        $answer_array = [];
//        for($i=1; $i <= $option_count; $i++){
//            $ans =  (int) $answer_data['answer'][0];
//            $answer_array[] = ( $i != $ans ) ? false : true;
//        }

//        dd($question_data);


        if (!empty($question_data)){
           $this->save([
               'question_text' => $request->question_text,
               'point' => $request->point,
               'tag_id' => $request->tag_id
           ]);
        }

//        if (!empty($option_data)){
//            for ($i = 0; $i<$option_count; $i++){
//
//                $this->optionService->save([
//                    'question_id' => $question->id,
//                    'option_text' => $option_data['option'][$i],
//                    'is_correct' => $answer_array[$i]
//                ]);
//
//            }
//            return redirect()->back();
//        }
        return new Response('Question added successfully');
    }
}