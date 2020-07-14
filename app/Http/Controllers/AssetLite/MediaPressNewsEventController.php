<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @param AlFaqService $faq
     */
    public function __construct(AlFaqService $faq)
    {
        $this->faq = $faq;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $response = $this->mediaPNE->storeAlFaq($request->all());
        return redirect();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
    public function update(Request $request, $id)
    {
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
    public function destroy($id)
    {
        $this->faq->deleteFaq($id);
        return url('faq');
    }
}
