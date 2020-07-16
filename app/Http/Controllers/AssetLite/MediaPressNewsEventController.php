<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqService;
use App\Services\MediaPressNewsEventService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MediaPressNewsEventController extends Controller
{
    /**
     * @var AlFaqService
     */
    private $mediaPNE;

    /**
     * RolesController constructor.
     * @param MediaPressNewsEventService $mediaPressNewsEventService
     */
    public function __construct(MediaPressNewsEventService $mediaPressNewsEventService)
    {
        $this->mediaPNE = $mediaPressNewsEventService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $pressNewsEvents = $this->mediaPNE->findAll();
        return view('admin.media.list_press_news_event', compact('pressNewsEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.media.create_press_news_event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->mediaPNE->storePNE($request->all());
        Session::flash('success', $response->getContent());
        return redirect('press-news-event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $pressNewsEvent = $this->mediaPNE->findOne($id);
        return view('admin.media.edit_press_news_event', compact('pressNewsEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->mediaPNE->updatePNE($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('press-news-event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->mediaPNE->deletePNE($id);
        return url('press-news-event');
    }
}
