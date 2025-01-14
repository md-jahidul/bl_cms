<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CorpContactInfoService;
use App\Services\CorpRespContactUsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CorporateRespContactUsController extends Controller
{
    /**
     * @var CorpRespContactUsService
     */
    private $contactUsService;
    /**
     * @var CorpContactInfoService
     */
    private $corpContactInfoService;

    public function __construct(
        CorpRespContactUsService $contactUsService,
        CorpContactInfoService $corpContactInfoService
    ) {
        $this->contactUsService = $contactUsService;
        $this->corpContactInfoService = $corpContactInfoService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $pages = $this->contactUsService->findAll();
        return view('admin.corporate-responsibility.contact-us.index', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $contactPage = $this->contactUsService->findOne($id);
        return view('admin.corporate-responsibility.contact-us.edit', compact('contactPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->contactUsService->updatePage($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('contact-us-page-info.index'));
    }

    public function customerContactInfoList()
    {
        $infoList = $this->corpContactInfoService->findAll();
        return view('admin.corporate-responsibility.contact-us.info-list.contact-list', compact('infoList'));
    }

    public function showCustomerDetails($id)
    {
        $details = $this->corpContactInfoService->findOne($id);
        return view('admin.corporate-responsibility.contact-us.info-list.customer-details', compact('details'));
    }
}
