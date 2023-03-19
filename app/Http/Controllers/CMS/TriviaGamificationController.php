<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\TriviaGamificationRequest;
use App\Models\TriviaGamification;
use App\Services\TriviaGamificationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class TriviaGamificationController extends Controller
{
    /**
     * @var TriviaGamificationService
     */
    private $triviaGamificationService;

    public function __construct(TriviaGamificationService $triviaGamificationService)
    {
        $this->triviaGamificationService = $triviaGamificationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $trivia = $this->triviaGamificationService->findAll()->first();
        return view('admin.trivia.create', compact('trivia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TriviaGamificationRequest $request)
    {
        $this->triviaGamificationService->saveTriviaInfo($request->all());
        Redis::del("mybl_home_component");
        return redirect()->route('trivia.create')->with('success', "Data saved successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TriviaGamification  $triviaGamification
     * @return Response
     */
    public function show(TriviaGamification $triviaGamification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TriviaGamification  $triviaGamification
     * @return Response
     */
    public function edit(TriviaGamification $triviaGamification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TriviaGamification  $triviaGamification
     * @return Response
     */
    public function update(Request $request, TriviaGamification $triviaGamification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TriviaGamification  $triviaGamification
     * @return Response
     */
    public function destroy(TriviaGamification $triviaGamification)
    {
        //
    }
}