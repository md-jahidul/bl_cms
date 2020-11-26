<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CorpContactUsFieldService;
use App\Services\CorpRespContactUsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CorpContactUsFieldController extends Controller
{
    /**
     * @var CorpRespContactUsService
     */
    private $contactUsService;
    /**
     * @var CorpContactUsFieldService
     */
    private $contactUsFieldService;


    /**
     * RolesController constructor.
     * @param CorpRespContactUsService $contactUsService
     * @param CorpContactUsFieldService $contactUsFieldService
     */
    public function __construct(
        CorpRespContactUsService $contactUsService,
        CorpContactUsFieldService $contactUsFieldService
    ) {
        $this->contactUsService = $contactUsService;
        $this->contactUsFieldService = $contactUsFieldService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($pageId)
    {
        $page = $this->contactUsService->findOrFail($pageId);
        $fields = $this->contactUsFieldService->getContactPageWiseField($pageId);
        return view('admin.corporate-responsibility.contact-us.field.index', compact('fields', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $sectionId
     * @return Application|Factory|Response|View
     */
    public function create($sectionId)
    {
        return view('admin.corporate-responsibility.contact-us.field.create', compact('sectionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Request $request, $sectionId)
    {
        $response = $this->contactUsFieldService->storeField($request->all(), $sectionId);
        Session::flash('success', $response->getContent());
        return redirect(route('contact-us-field.index', $sectionId));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($sectionId, $id)
    {
        $field = $this->contactUsFieldService->findOne($id);
        return view('admin.corporate-responsibility.contact-us.field.edit', compact('field', 'sectionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $sectionId
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, $sectionId, $id)
    {
        $response = $this->contactUsFieldService->updateField($request->all(), $sectionId, $id);
        Session::flash('message', $response->getContent());
        return redirect(route('contact-us-field.index', $sectionId));
    }

    public function sectionSortable(Request $request)
    {
        return $this->contactUsFieldService->tableSort($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $sectionId
     * @param int $id
     * @return Application|UrlGenerator|string|void
     */
    public function destroy($sectionId, $id)
    {
        $this->contactUsFieldService->deleteField($id);
        return route('contact-us-field.index', $sectionId);
    }
}
