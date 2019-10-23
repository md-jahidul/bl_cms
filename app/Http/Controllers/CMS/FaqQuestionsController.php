<?php

namespace App\Http\Controllers\CMS;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Services\FaqQuestionsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqQuestionsController extends Controller
{
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

        $category = FaqCategory::app()->orderBy('title')->get()->pluck('title', 'id');

        return view('admin.faq.question.index', compact('category'));
    }

    public function create()
    {
        $action = route('faq.questions.store');
        $edit = false;
        $selected_category = null;

        $category = FaqCategory::app()->orderBy('title')->get()->pluck('title', 'id');

        return view('admin.faq.question.show', compact('action', 'edit', 'category', 'selected_category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'bail|required|exists:faq_categories,id',
            'question' => 'bail|required|string',
            'answer' => 'bail|required|string'
        ]);

        return $this->service->store($request, 'app');
    }

    public function show($id)
    {
        $edit = true;
        $question = FaqQuestion::find($id);

        if (!$question) {
            abort('404');
        }

        $action = route('faq.questions.update', $question->id);

        $selected_category = $question->category_id;
        $category = FaqCategory::app()->orderBy('title')->get()->pluck('title', 'id');

        return view('admin.faq.question.show', compact('action', 'edit', 'category', 'selected_category', 'question'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'category' => 'bail|required|exists:faq_categories,id',
            'question' => 'bail|required|string',
            'answer' => 'bail|required|string'
        ]);

        return $this->service->update($id, $request);
    }

    public function delete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:faq_questions,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => ' FAILED',
                'message' => 'Invalid Questions'
            ], 322);
        }

        return $this->service->delete($request);
    }
}
