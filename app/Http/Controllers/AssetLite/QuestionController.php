<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AnswerOptionService;
use App\Services\QuestionService;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{

    protected $questionService;

    protected $tagService;

    protected $answerOptionService;


    /**
     * QuestionController constructor.
     * @param QuestionService $questionService
     * @param TagService $tagService
     * @param AnswerOptionService $answerOptionService
     */
    public function __construct(QuestionService $questionService, TagService $tagService, AnswerOptionService $answerOptionService)
    {
        $this->questionService = $questionService;
        $this->tagService = $tagService;
        $this->answerOptionService = $answerOptionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionService->findAll('', 'tag');
        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tagService->findAll();
        return view('admin.question.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->questionService->storeQuestion($request);
        Session::flash('message', $response->getContent());
        return redirect('/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = $this->tagService->findAll();
        $question = $this->questionService->findOne($id, 'answerOptions');
        $options = $question->answerOptions;
        return view('admin.question.edit', compact('question', 'tags', 'options'));
    }

    /**
     * @param  Request $request
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->questionService->updateQuestion($request, $id);
        Session::flash('message', $response->getContent());
        return redirect('questions');
    }

    /**
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->questionService->deleteQuestion($id);
        Session::flash('message', $response->getContent());
        return redirect('/questions');
    }
}
