<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SupportMessageService;

class SupportMessageRatingController extends Controller
{
     /**
     * @var SupportMessageService
     */
    protected $supportMessageService;

     /**
     * StoreController constructor.
     * @param SupportMessageService $storeService
     */

    public function __construct(SupportMessageService $supportMessageService) {
        $this->supportMessageService = $supportMessageService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $category=[];
        $faqs=$this->supportMessageService->getSupportMessageList();
        dd($faqs);
        return view('admin.support-massage.index', compact('faqs','category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupportMessagRating  $supportMessagRating
     * @return \Illuminate\Http\Response
     */
    public function show(SupportMessagRating $supportMessagRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupportMessagRating  $supportMessagRating
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportMessagRating $supportMessagRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupportMessagRating  $supportMessagRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportMessagRating $supportMessagRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupportMessagRating  $supportMessagRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportMessagRating $supportMessagRating)
    {
        //
    }
}
