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
    public function __construct(CustomerFeedbackQuesService $feedback)
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
        return view('admin.customer_feedback.question.index');
    }

    public function getFeedbacks()
    {

    }

}
