<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CustomerFeedbackService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CustomerFeedbackController extends Controller {

    /**
     * @var $feedback
     */
    private $feedback;

    /**
     * CustomerFeedbackController constructor.
     * @param CustomerFeedbackService $feedback
     */
    public function __construct(CustomerFeedbackService $feedback) {
        $this->feedback = $feedback;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function questions() {

//        $service_url = "https://api.lever.co/v1/postings";
//
//        $curl = curl_init($service_url);
//
//        $apiKey = "RZR5Kvm09lMlCGPYAq9IAWlA8G6KlddNqv4jNbmSjHoyLKtV";
//
//        curl_setopt($curl, CURLOPT_USERPWD, $apiKey);  
//        
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
////            'Authorization: Basic ' . $apiKey
//             
//        ));
//
//
//        $curl_response = curl_exec($curl);
//
//        curl_close($curl);
//
//        $decoded = json_decode($curl_response, true);
//
//        echo "<pre>";
//        print_r($decoded);
//        die();


        $questions = $this->feedback->getQuestions();
        
        return view('admin.customer_feedback.index', compact('questions'));
    }

   /**
     * Question add form
     * 
     * @param N/A
     * @return View
     * @Dev Bulbul Mahmud Nito || 19/07/2020
     */
    public function addQuestion() {
        return view('admin.customer_feedback.create_question');
    }
    
   /**
     * Question edit form
     * 
     * @param $questionId
     * @return View
     * @Dev Bulbul Mahmud Nito || 19/07/2020
     */
    public function editQuestion($questionId) {
        $question = $this->feedback->getQuestionData($questionId);
        return view('admin.customer_feedback.edit_question', compact('question'));
    }

     /**
     * Question save/update
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 19/07/2020
     */
    public function saveQuestion(Request $request) {
          $response = $this->feedback->saveQuestion($request);
          
           if ($response['success'] == 1) {
            Session::flash('sussess', 'Question is saved!');
        } else {
            Session::flash('error', 'Question saving process failed!');
        }
        return redirect('/customer-feedback/questions');
    }
    
    
    
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id) {
        $faq = $this->faq->findOne($id);
        return view('admin.al-faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id) {
//        dd($request->all());
        $response = $this->faq->updateFaq($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('faq');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id) {
        $this->faq->deleteFaq($id);
        return url('faq');
    }

}
