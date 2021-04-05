<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BaseMsisdnService;
use App\Http\Requests\BaseMsisdnRequest;
use Illuminate\Support\Facades\Storage;

class BaseMsisdnController extends Controller
{
    /**
     * @var BaseMsisdnService
     */
    private $baseMsisdnService;

    /**
     * BaseMsisdnController constructor.
     * @param \App\Services\BaseMsisdnService $baseMsisdnService
     */
    public function __construct(BaseMsisdnService $baseMsisdnService)
    {
        $this->baseMsisdnService = $baseMsisdnService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baseList = '';
        return view('admin.myblslider.base.index', compact('baseList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $baseList = '';
        $page='create';
        return view('admin.myblslider.base.create', compact('baseList','page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BaseMsisdnRequest $request)
    {

        $response = $this->baseMsisdnService->storeBaseMsisdnGroup($request);
        Session()->flash('message', $response->content());
        return redirect(route('myblslider.baseMsisdnList.index'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
