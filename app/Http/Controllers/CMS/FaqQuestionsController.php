<?php

namespace App\Http\Controllers\CMS;
use App\Services\FaqQuestionsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqQuestionsController extends Controller
{
    /**
     * @var FaqQuestionsService
     */
    protected $service;

    public function __construct(FaqQuestionsService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $builder = $this->service->getAll()->app()->latest();
            return $this->service->prepareDataForDatatable($builder, $request);
        }

        return view('admin.faq.question.index');
    }

}
