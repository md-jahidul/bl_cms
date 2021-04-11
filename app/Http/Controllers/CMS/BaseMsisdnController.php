<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BaseMsisdnService;
use App\Http\Requests\BaseMsisdnRequest;
use Illuminate\Support\Facades\Session;
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
        ini_set('max_execution_time', 120);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $baseList = $this->baseMsisdnService->findAll();
        return view('admin.myblslider.base.index', compact('baseList'));
    }

    public function getBaseMsisdn(Request $request, $id)
    {
        return $this->baseMsisdnService->getBaseMsisdn($request, $id);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function msisdnExcelExport($id)
    {
        $response = $this->baseMsisdnService->excelGenerator($id);
        if ($response) {
            Session::flash('error', $response->getContent());
            return redirect(route('lead-list'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $baseList = '';
        $page = 'create';
        return view('admin.myblslider.base.create', compact('baseList', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BaseMsisdnRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $baseMsisdn = $this->baseMsisdnService->findOne($id, 'baseMsisdns');
        $page = 'edit';
        return view('admin.myblslider.base.create', compact('baseMsisdn', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->baseMsisdnService->updateBaseMsisdnGroup($request, $id);
        Session()->flash('message', $response->content());
        return redirect(route('myblslider.baseMsisdnList.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
