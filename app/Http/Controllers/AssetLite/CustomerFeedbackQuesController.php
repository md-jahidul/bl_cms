<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CustomerFeedbackQuesService;
use App\Services\CustomerFeedbackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CustomerFeedbackQuesController extends Controller
{

    /**
     * @var $feedback
     */
    private $feedback;

    /**
     * CustomerFeedbackController constructor.
     * @param CustomerFeedbackQuesService $feedback
     */
    public function __construct(CustomerFeedbackQuesService $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function questions()
    {
        $questions = $this->feedback->getQuestions();
        return view('admin.customer_feedback.question.index', compact('questions'));
    }

    /**
     * Question add form
     *
     * @param N/A
     * @return View
     * @Dev Bulbul Mahmud Nito || 19/07/2020
     */
    public function addQuestion()
    {
        return view('admin.customer_feedback.question.create_question');
    }

    /**
     * Question edit form
     *
     * @param $questionId
     * @return View
     * @Dev Bulbul Mahmud Nito || 19/07/2020
     */
    public function editQuestion($questionId)
    {
        $question = $this->feedback->getQuestionData($questionId);
        return view('admin.customer_feedback.question.edit_question', compact('question'));
    }

    /**
     * Question save/update
     *
     * @param Request $request
     * @return JsonResponse|Application|RedirectResponse|Redirector
     * @Dev Bulbul Mahmud Nito || 19/07/2020
     */
    public function saveQuestion(Request $request)
    {
        $response = $this->feedback->saveQuestion($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Question is saved!');
        } else {
            Session::flash('error', 'Question saving process failed!');
        }
        return redirect('/customer-feedback/questions');
    }

    public function questionSortable(Request $request)
    {
        $this->feedback->tableSortable($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->feedback->deleteQuestion($id);
        return url('customer-feedback/questions');
    }

}
