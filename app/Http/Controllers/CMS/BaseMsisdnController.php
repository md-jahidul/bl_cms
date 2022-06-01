<?php

namespace App\Http\Controllers\CMS;

use App\Repositories\BaseMsisdnFileRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BaseMsisdnService;
use App\Http\Requests\BaseMsisdnRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;


class BaseMsisdnController extends Controller
{
    /**
     * @var BaseMsisdnService
     */
    private $baseMsisdnService;
    /**
     * @var BaseMsisdnFileRepository
     */
    private $baseMsisdnFileRepository;

    /**
     * BaseMsisdnController constructor.
     * @param \App\Services\BaseMsisdnService $baseMsisdnService
     */
    public function __construct(
        BaseMsisdnService $baseMsisdnService,
        BaseMsisdnFileRepository $baseMsisdnFileRepository
    ) {
        $this->baseMsisdnService = $baseMsisdnService;
        $this->baseMsisdnFileRepository = $baseMsisdnFileRepository;
        ini_set('max_execution_time', 120);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orderBy = ['column' => 'created_at', 'direction' => 'DESC'];
        $baseList = $this->baseMsisdnService->findBy([''], '', $orderBy);
        return view('admin.myblslider.base.index', compact('baseList'));
    }

    public function getBaseMsisdn(Request $request, $id)
    {
        return $this->baseMsisdnService->getBaseMsisdn($request, $id);
    }


    /**
     * @param $id
     * @return Application|RedirectResponse|\Illuminate\Routing\Redirector
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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return Application|RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     */
    public function store(BaseMsisdnRequest $request)
    {
        $response = $this->baseMsisdnService->storeBaseMsisdnGroup($request);
        if ($response['status']) {
            Session()->flash('warning', $response['base_title_en']. ' Upload is processing...');
            return redirect(route('myblslider.baseMsisdnList.index'));
        }
        Session()->flash('error', $response['message']);
        return back();
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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $baseMsisdn = $this->baseMsisdnService->findOne($id, 'baseMsisdns');
        $baseMsisdnFiles = $this->baseMsisdnFileRepository->findByProperties(['base_msisdn_group_id' => $id]);
        $keyValue = Redis::get("categories-sync-with-product".$id);
    
        $page = 'edit';
        return view('admin.myblslider.base.create', compact('baseMsisdn', 'page', 'baseMsisdnFiles', 'keyValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->baseMsisdnService->updateBaseMsisdnGroup($request, $id);
        if ($response['status']) {
            // Session()->flash('warning', $response['base_title_en']. ' Upload is processing.');
            return back();
        }
        Session()->flash('error', $response['message']);
        return back();
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
