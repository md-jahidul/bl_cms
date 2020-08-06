<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StorePartnerRequest;
use App\Services\PartnerService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Validator;

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
     * @return Factory|View
     */
    public function index()
    {
        $partners = $this->partnerService->findAll('', 'partnerCategory');
        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $partnerCategories = $this->partnerService->partnerCategories();
        return view('admin.partner.create', compact('partnerCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePartnerRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(StorePartnerRequest $request)
    {
        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();
        
        # Check Image upload validation
        $validator = Validator::make($request->all(), [
            'company_logo' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('partners');
        }
        
        $response = $this->partnerService->storePartner($request->all());
        Session::flash('message', $response->getContent());
        return redirect('partners');
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
     * @return Response
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
     * @return Response
     */
    public function update(StorePartnerRequest $request, $id)
    {

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();
        
        # Check Image upload validation
        $validator = Validator::make($request->all(), [
            'company_logo' => 'nullable|mimes:'.$image_upload_type.'|max:'.$image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('partners');
        }

        $response = $this->partnerService->updatePartner($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('partners');
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->partnerService->deletePartner($id);
        Session::flash('message', $response->getContent());
        return url('partners');
    }
}
