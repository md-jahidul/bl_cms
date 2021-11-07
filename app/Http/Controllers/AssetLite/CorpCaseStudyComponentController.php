<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\CorpCaseStudyComponentRequest;
use App\Models\CorpCaseStudyReportSection;
use App\Services\CorpCaseStudyComponentService;
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

class CorpCaseStudyComponentController extends Controller
{
    /**
     * @var CorpCaseStudyComponentService
     */
    private $corpCaseStudyComponentService;
    /**
     * @var CorpCaseStudyReportSection
     */
    private $corporateCaseStudySection;

    /**
     * RolesController constructor.
     * @param CorpCaseStudyReportSection $corporateCaseStudySection
     * @param CorpCaseStudyComponentService $corpCaseStudyComponentService
     */
    public function __construct(
        CorpCaseStudyReportSection $corporateCaseStudySection,
        CorpCaseStudyComponentService $corpCaseStudyComponentService
    ) {
        $this->corporateCaseStudySection = $corporateCaseStudySection;
        $this->corpCaseStudyComponentService = $corpCaseStudyComponentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($sectionId)
    {
        $section = $this->corporateCaseStudySection->findOrFail($sectionId);
        $components = $this->corpCaseStudyComponentService->getSectionWiseComponent($sectionId);
        $count  = count($components);
        return view('admin.corporate-responsibility.case-study-and-report.section-component.index',
            compact('components', 'section', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $sectionId
     * @return Application|Factory|Response|View
     */
    public function create($sectionId)
    {
        return view('admin.corporate-responsibility.case-study-and-report.section-component.create', compact('sectionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(CorpCaseStudyComponentRequest $request, $sectionId)
    {
        $response = $this->corpCaseStudyComponentService->storeComponent($request->all(), $sectionId);
        Session::flash('success', $response->getContent());
        return redirect(route('case-study-component.index', $sectionId));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($sectionId, $id)
    {
        $component = $this->corpCaseStudyComponentService->findOne($id);
        return view('admin.corporate-responsibility.case-study-and-report.section-component.edit', compact('component', 'sectionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $sectionId
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(CorpCaseStudyComponentRequest $request, $sectionId, $id)
    {
        $response = $this->corpCaseStudyComponentService->updateComponent($request->all(), $sectionId, $id);
        Session::flash('message', $response->getContent());
        return redirect(route('case-study-component.index', $sectionId));
    }

    public function sectionSortable(Request $request)
    {
        return $this->corpCaseStudyComponentService->tableSort($request);
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
        $this->corpCaseStudyComponentService->deleteComponent($id);
        return route('case-study-component.index', $sectionId);
    }
}
