<?php

namespace App\Http\Controllers\CMS;

use App\Services\MyBlServiceComponentService;
use App\Repositories\MyBlServiceItemRepository;
use App\Services\MyBlServiceItemsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImageStoreRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MyBlServiceItemsController extends Controller
{

    private $serviceItemRepository;
    private $myBlService;
    private $blServiceItemsService;

    public function __construct(
        MyBlServiceItemRepository   $serviceItemRepository,
        MyBlServiceComponentService $myBlService,
        MyBlServiceItemsService     $blServiceItemsService
    )
    {
        $this->serviceItemRepository = $serviceItemRepository;
        $this->myBlService = $myBlService;
        $this->blServiceItemsService = $blServiceItemsService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @param $sliderId
     * @return Factory|View
     */
    public function index($service_id)
    {
        $service = $this->myBlService->findOne($service_id);
        $service_items = $this->blServiceItemsService->itemList($service_id);
        return view(
            'admin.my-bl-services.items.index',
            compact('service_id', 'service', 'service_items')
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create($service_id)
    {
        $service_information = $this->myBlService->findOne($service_id);
        return view('admin.my-bl-services.items.create', compact('service_id', 'service_information'));
    }

    /**return redirect(route('myblslider.index'));
     * Store a newly created resource in storage.
     *
     * @param SliderImageStoreRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        session()->flash('message', $this->blServiceItemsService->storeServiceItems($request->all())->getContent());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    public function updatePosition(Request $request)
    {
        return $this->blServiceItemsService->updatePosition($request);
    }


    public function edit($id)
    {

        $itemInfo = $this->blServiceItemsService->findOne($id);
        $android_version_code = implode('-', [$itemInfo['android_version_code_min'], $itemInfo['android_version_code_max']]);
        $ios_version_code = implode('-', [$itemInfo['ios_version_code_min'], $itemInfo['ios_version_code_max']]);
        $itemInfo->android_version_code = $android_version_code;
        $itemInfo->ios_version_code = $ios_version_code;
        return view('admin.my-bl-services.items.edit', compact('itemInfo'));
    }


    public function update(Request $request, $id)
    {
        session()->flash('success', $this->blServiceItemsService->updateServiceItems($request->all(), $id)->getContent());
        return redirect()->back();
    }

    public function destroy($id)
    {
        session()->flash('error', $this->blServiceItemsService->deleteServiceItem($id)->getContent());
        return redirect()->back();
    }
}
