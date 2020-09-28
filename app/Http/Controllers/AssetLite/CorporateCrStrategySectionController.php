<?php

namespace App\Http\Controllers\AssetLite;

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

class CorporateCrStrategySectionController extends Controller
{
    /**
     * @var CorporateCrStrategySectionService
     */
    private $corpCrStrategy;

    /**
     * RolesController constructor.
     * @param CorporateCrStrategySectionService $corporateCrStrategySectionService
     */
    public function __construct(
        CorporateCrStrategySectionService $corporateCrStrategySectionService
    ) {
        $this->corpCrStrategy = $corporateCrStrategySectionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $sections = $this->corpCrStrategy->findAll('', '', $orderBy);
        return view('admin.corporate-responsibility.cr-strategy.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.corporate-responsibility.cr-strategy.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Request $request)
    {
        $response = $this->corpCrStrategy->storeSection($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('cr-strategy-section.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($id)
    {
        $section = $this->corpCrStrategy->findOne($id);
        return view('admin.corporate-responsibility.cr-strategy.section.edit', compact('section'));
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
        $response = $this->corpCrStrategy->updateSection($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('cr-strategy-section.index'));
    }

    public function sectionSortable(Request $request)
    {
        return $this->corpCrStrategy->tableSort($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|UrlGenerator|string|void
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->corpCrStrategy->deleteSection($id);
        return url('corporate/cr-strategy-section');
    }
}
