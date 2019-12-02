<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 28-Aug-19
 * Time: 12:57 PM
 */

namespace App\Services;

use App\Repositories\AnswerOptionRepository;
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

    /**
     * @var AnswerOptionRepository
     */
    protected $answerOptionService;

    /**
     * QuestionService constructor.
     * @param QuestionRepository $questionRepository
     * @param AnswerOptionRepository $answerOptionRepository
     */
    public function __construct(QuestionRepository $questionRepository, AnswerOptionRepository $answerOptionRepository)
    {
        $this->questionService = $questionRepository;
        $this->answerOptionService = $answerOptionRepository;
        $this->setActionRepository($questionRepository);
    }

    /**
     * @param $request
     * @return Response
     */
    public function storeQuestion($request)
    {
        $question_id = $this->questionService->createQuestion($request);
        $this->answerOptionService->optionAnswerCreate($request, $question_id);
        return new Response('Question added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateQuestion($data, $id)
    {
        $this->questionService->questionUpdate($data, $id);
        $this->answerOptionService->updateOptionAnswer($data, $id);
        return Response('Question updated successfully');
    }

    public function deleteQuestion($id)
    {
        $tag = $this->findOne($id);
        $tag->delete();
        return Response('Question deleted successfully !');
    }
}
