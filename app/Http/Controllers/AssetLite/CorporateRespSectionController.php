<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CorporateRespSectionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CorporateRespSectionController extends Controller
{
    /**
     * @var CorporateRespSectionService
     */
    private $corpRespSectionService;

    public function __construct(CorporateRespSectionService $corporateRespSectionService)
    {
        $this->corpRespSectionService = $corporateRespSectionService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $sections = $this->corpRespSectionService->findAll();
        return view('admin.corporate-responsibility.section.index', compact('sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $section = $this->corpRespSectionService->findOne($id);
        return view('admin.corporate-responsibility.section.edit', compact('section'));
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
        $response = $this->corpRespSectionService->updateCorpRespSection($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("corporate-resp-section");
    }
}
