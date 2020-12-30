<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CorporateCaseStudySectionService;
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

class CorpCaseStudySectionController extends Controller
{
    /**
     * @var CorporateCaseStudySectionService
     */
    private $corpCaseStudy;

    /**
     * RolesController constructor.
     * @param CorporateCaseStudySectionService $corporateCaseStudySectionService
     */
    public function __construct(
        CorporateCaseStudySectionService $corporateCaseStudySectionService
    ) {
        $this->corpCaseStudy = $corporateCaseStudySectionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $sections = $this->corpCaseStudy->findAll('', '', $orderBy);
        return view('admin.corporate-responsibility.case-study-and-report.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.corporate-responsibility.case-study-and-report.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Request $request)
    {
        $response = $this->corpCaseStudy->storeSection($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('case-study-section.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($id)
    {
        $section = $this->corpCaseStudy->findOne($id);
        return view('admin.corporate-responsibility.case-study-and-report.section.edit', compact('section'));
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
        $response = $this->corpCaseStudy->updateSection($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('case-study-section.index'));
    }

    public function sectionSortable(Request $request)
    {
        return $this->corpCaseStudy->tableSort($request);
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
        $this->corpCaseStudy->deleteSection($id);
        return url('corporate/case-study-section');
    }
}
