<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\DynamicPageStoreRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\DynamicPageService;
use App\Services\FourGCampaignService;
use App\Services\FourGDevicesService;
use App\Services\TagCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class FourGDevicesController extends Controller
{
    /**
     * @var FourGDevicesService
     */
    private $fourGDevicesService;
    /**
     * @var TagCategoryService
     */
    private $tagCategoryService;

    /**
     * DynamicPageController constructor.
     * @param FourGDevicesService $fourGDevicesService
     * @param TagCategoryService $tagCategoryService
     */
    public function __construct(
        FourGDevicesService $fourGDevicesService,
        TagCategoryService $tagCategoryService
    ) {
        $this->fourGDevicesService = $fourGDevicesService;
        $this->tagCategoryService = $tagCategoryService;
    }

    public function index()
    {
        $devices = $this->fourGDevicesService->findAll();
        return view('admin.banglalink-4g.devices.index', compact('devices'));
    }

    public function create()
    {
        $tags = $this->tagCategoryService->findAll();
        return view('admin.banglalink-4g.devices.create', compact('tags'));
    }

    public function edit($id)
    {
        $device = $this->fourGDevicesService->findOne($id);
        $tags = $this->tagCategoryService->findAll();
        return view('admin.banglalink-4g.devices.edit', compact('device', 'tags'));
    }

    public function store(Request $request)
    {
        $response = $this->fourGDevicesService->storeDevices($request->all());
        if ($response['success'] == 1) {
            Session::flash('success', $response['message']);
        } else {
            Session::flash('error', $response['message']);
        }
        return redirect('/bl-4g-devices');
    }

    public function update(Request $request, $id)
    {
        $response = $this->fourGDevicesService->updateDevices($request->all(), $id);
        if ($response['success'] == 1) {
            Session::flash('success', $response['message']);
        } else {
            Session::flash('error', $response['message']);
        }
        return redirect('/bl-4g-devices');
    }

    public function destroy($id)
    {
        $response = $this->fourGDevicesService->deleteDevices($id);
        if ($response['success'] == 1) {
            Session::flash('sussess', $response['message']);
        } else {
            Session::flash('error', $response['message']);
        }
        return url('/bl-4g-devices');
    }
}
