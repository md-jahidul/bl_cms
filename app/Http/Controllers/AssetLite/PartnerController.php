<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StorePartnerRequest;
use App\Services\PartnerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
{
    /**
     * @var $partnerService
     */
    private $partnerService;

    /**
     * PartnerController constructor.
     * @param PartnerService $partnerService
     */
    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = $this->partnerService->findAll('', 'partnerCategory');
        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partnerCategories = $this->partnerService->partnerCategories();
        return view('admin.partner.create', compact('partnerCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerRequest $request)
    {
        $response = $this->partnerService->storePartner($request->all());
        Session::flash('message', $response->getContent());
        return redirect('partners');
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
        $partner = $this->partnerService->findOne($id);
        $partnerCategories = $this->partnerService->partnerCategories();
        return view('admin.partner.edit', compact('partner', 'partnerCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePartnerRequest $request, $id)
    {
        $response = $this->partnerService->updatePartner($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('partners');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->partnerService->deletePartner($id);
        Session::flash('message', $response->getContent());
        return url('partners');
    }
}
