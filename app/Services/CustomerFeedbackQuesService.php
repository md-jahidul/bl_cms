<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\CustomerFeedbackQuesRepository;
use App\Repositories\CustomerFeedbackRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerFeedbackQuesService
{

    use CrudTrait;

    /**
     * @var $feedRepo
     */
    protected $feedRepo;

    /**
     * CustomerFeedbackService constructor.
     * @param CustomerFeedbackRepository $feedRepo
     */
    public function __construct(CustomerFeedbackQuesRepository $feedRepo)
    {
        $this->feedRepo = $feedRepo;
        $this->setActionRepository($feedRepo);
    }

    public function getQuestions()
    {
        return $this->feedRepo->getQuestions();
    }

    public function getQuestionData($questionId)
    {
        return $this->feedRepo->getQuestionData($questionId);
    }

    /**
     * Save internet package
     * @param $request
     * @return array|int[]
     */
    public function saveQuestion($request)
    {
        try {
            $request->validate([
                'question_en' => 'required',
                'question_bn' => 'required',
            ]);
            $this->feedRepo->saveQuestion($request);
            return ['success' => 1];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    public function tableSortable($data)
    {
        $this->feedRepo->tableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteQuestion($id)
    {
        $question = $this->findOne($id);
        $question->delete();
        return Response('Question has been successfully deleted');
    }
}
