<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CustomerFeedbackQuesService;
use App\Services\CustomerFeedbackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CustomerFeedbackController extends Controller
{

    /**
     * @var $feedback
     */
    private $feedback;

    /**
     * CustomerFeedbackController constructor.
     * @param CustomerFeedbackQuesService $feedback
     */
    public function __construct(CustomerFeedbackService $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.customer_feedback.feedback-list');
    }

    public function getFeedbacks(Request $request)
    {
        return $this->feedback->feedBackData($request);
    }

    /**
     * @param $feedbackId
     * @return Application|Factory|View
     */
    public function feedbacksDetails($feedbackId)
    {
        $feedback = $this->feedback->findOne($feedbackId);
        $feedbackDetails = json_decode($feedback->answers, true);
        return view('admin.customer_feedback.feedback-details', compact('feedbackDetails'));
    }

    public function pageWiseRating()
    {
        $pagesInfo = $this->feedback->pageRatingInfo();
//        return $pagesInfo;
        return view('admin.customer_feedback.feedback-page-details', compact('pagesInfo'));
    }
}
