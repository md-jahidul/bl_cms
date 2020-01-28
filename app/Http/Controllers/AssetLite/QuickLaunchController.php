<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreQuickLaunch;
use App\Services\QuickLaunchService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class QuickLaunchController extends Controller
{

    /**
     * @var $quickLaunchService
     */
    private $quickLaunchService;

    /**
     * QuickLaunchController constructor.
     * @param QuickLaunchService $quickLaunchService
     */
    public function __construct(QuickLaunchService $quickLaunchService)
    {
        $this->quickLaunchService = $quickLaunchService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @return Factory|View
     */
    public function index($type)
    {
        $quickLaunchItems = $this->quickLaunchService->itemList($type);
        return view('admin.quick-launch-item.index', compact('quickLaunchItems', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return Factory|View
     */
    public function create($type)
    {
        return view('admin.quick-launch-item.create', compact('type'));
    }

    /**
     * @param StoreQuickLaunch $request
     * @param $type
     * @return RedirectResponse|Redirector
     */
    public function store(StoreQuickLaunch $request, $type)
    {
        $response = $this->quickLaunchService->storeQuickLaunchItem($request->all(), $type);
        Session::flash('message', $response->getContent());
        return redirect("quick-launch/$type");
    }

    /**
     * @param Request $request
     */
    public function quickLaunchSortable(Request $request)
    {
        $this->quickLaunchService->tableSortable($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($type, $id)
    {
        $quickLaunch = $this->quickLaunchService->findOne($id);
        return view('admin.quick-launch-item.edit', compact('quickLaunch', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $type, $id)
    {
        $response = $this->quickLaunchService->updateQuickLaunch($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("/quick-launch/$type");
    }

    /**
     * @param $type
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($type, $id)
    {
        $response = $this->quickLaunchService->deleteQuickLaunch($id);
        Session::flash('message', $response->getContent());
        return url("quick-launch/$type");
    }
}
