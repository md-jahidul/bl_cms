<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\CorpCrStrategyComRequest;
use App\Models\CorporateCrStrategySection;
use App\Services\CorpCrStrategyComponentService;
use App\Services\CorporateCrStrategySectionService;
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

class CorpCrStrategyComponentController extends Controller
{
    /**
     * @var CorpCrStrategyComponentService
     */
    private $corpCrStrategyComponentService;

    protected $pageType = "cr_strategy_section";
    /**
     * @var CorporateCrStrategySection
     */
    private $corporateCrStrategySection;

    /**
     * RolesController constructor.
     * @param CorporateCrStrategySection $corporateCrStrategySection
     * @param CorpCrStrategyComponentService $corpCrStrategyComponentService
     */
    public function __construct(
        CorporateCrStrategySection $corporateCrStrategySection,
        CorpCrStrategyComponentService $corpCrStrategyComponentService
    ) {
        $this->corporateCrStrategySection = $corporateCrStrategySection;
        $this->corpCrStrategyComponentService = $corpCrStrategyComponentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($sectionId)
    {
        $section = $this->corporateCrStrategySection->findOrFail($sectionId);
        $components = $this->corpCrStrategyComponentService->getSectionWiseComponent($sectionId);

        return view('admin.corporate-responsibility.cr-strategy.section-component.index',
            compact('components', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $sectionId
     * @return Application|Factory|Response|View
     */
    public function create($sectionId)
    {
        return view('admin.corporate-responsibility.cr-strategy.section-component.create', compact('sectionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $sectionId
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(CorpCrStrategyComRequest $request, $sectionId)
    {
        $response = $this->corpCrStrategyComponentService->storeComponent($request->all(), $this->pageType, $sectionId);
        Session::flash('success', $response->getContent());
        return redirect(route('cr-strategy-component.index', $sectionId));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($sectionId, $id)
    {
        $component = $this->corpCrStrategyComponentService->findOne($id);
        return view('admin.corporate-responsibility.cr-strategy.section-component.edit', compact('component', 'sectionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $sectionId
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(CorpCrStrategyComRequest $request, $sectionId, $id)
    {
        $response = $this->corpCrStrategyComponentService->updateComponent($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('cr-strategy-component.index', $sectionId));
    }

    public function sectionSortable(Request $request)
    {
        return $this->corpCrStrategyComponentService->tableSort($request);
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
        $this->corpCrStrategyComponentService->deleteComponent($id);
        return route('cr-strategy-component.index', $sectionId);
    }
}
