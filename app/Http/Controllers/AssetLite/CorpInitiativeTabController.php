<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\CorporateInitiativeTabService;
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

class CorpInitiativeTabController extends Controller
{
    /**
     * @var CorporateInitiativeTabService
     */
    private $corpInitiativeTab;

    /**
     * RolesController constructor.
     * @param CorporateInitiativeTabService $corporateInitiativeTabService
     */
    public function __construct(
        CorporateInitiativeTabService $corporateInitiativeTabService
    ) {
        $this->corpInitiativeTab = $corporateInitiativeTabService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $tabs = $this->corpInitiativeTab->findAll('', '', $orderBy);
        return view('admin.corporate-responsibility.initiative.tab.index', compact('tabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.corporate-responsibility.initiative.tab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Request $request)
    {
        $response = $this->corpInitiativeTab->storeTab($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('initiative-tab.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($id)
    {
        $tab = $this->corpInitiativeTab->findOne($id);
        return view('admin.corporate-responsibility.initiative.tab.edit', compact('tab'));
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
        $response = $this->corpInitiativeTab->updateTab($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('initiative-tab.index'));
    }

    public function tabSortable(Request $request)
    {
        return $this->corpInitiativeTab->tableSort($request);
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
        $this->corpInitiativeTab->deleteTab($id);
        return url('corporate/initiative-tab');
    }
}
