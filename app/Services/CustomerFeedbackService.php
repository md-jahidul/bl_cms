<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\CustomerFeedbackRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerFeedbackService {
    
    use CrudTrait;

    /**
     * @var $feedRepo
     */
    protected $feedRepo;

    /**
     * CustomerFeedbackService constructor.
     * @param CustomerFeedbackRepository $feedRepo
     */
    public function __construct(CustomerFeedbackRepository $feedRepo)
    {
        $this->feedRepo = $feedRepo;
        $this->setActionRepository($feedRepo);
    }
    
    public function getQuestions(){
        $questions = $this->feedRepo->getQuestions();
        return $questions;
    }
    
    public function getQuestionData($questionId){
        $questions = $this->feedRepo->getQuestionData($questionId);
        return $questions;
    }
    
    
     /**
     * Save internet package
     * @return Response
     */
    public function saveQuestion($request) {
        try {

            $request->validate([
                'question_en' => 'required',
                'question_bn' => 'required',
            ]);

            $this->feedRepo->saveQuestion($request);

            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * Storing the alFaq resource
     * @return Response
     */
    public function storeAlFaq($data)
    {
        $data['image_path'] = 'storage/' . $data['image_path']->store('banner');
        $this->save($data);
        return new Response("Banner has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateFaq($data, $id)
    {
        $faq = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        unset($data['files']);
        $faq->update($data);
        return Response('Faq has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteFaq($id)
    {
        $faq = $this->findOne($id);
        $faq->delete();
        return Response('Faq has been successfully deleted');
    }
}
