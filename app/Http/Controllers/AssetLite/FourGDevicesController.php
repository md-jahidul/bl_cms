<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\FourGDevicesService;
use App\Services\FourGDeviceTagService;
use App\Services\TagCategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @var FourGDeviceTagService
     */
    private $fourGDeviceTagService;

    /**
     * DynamicPageController constructor.
     * @param FourGDevicesService $fourGDevicesService
     * @param TagCategoryService $tagCategoryService
     * @param FourGDeviceTagService $fourGDeviceTagService
     */
    public function __construct(
        FourGDevicesService $fourGDevicesService,
        TagCategoryService $tagCategoryService,
        FourGDeviceTagService $fourGDeviceTagService
    ) {
        $this->fourGDevicesService = $fourGDevicesService;
        $this->tagCategoryService = $tagCategoryService;
        $this->fourGDeviceTagService = $fourGDeviceTagService;
    }

    public function index()
    {
        $devices = $this->fourGDevicesService->findAll();
        return view('admin.banglalink-4g.devices.index', compact('devices'));
    }

    public function create()
    {
        $tags = $this->tagCategoryService->findAll();
        $deviceTags = $this->fourGDeviceTagService->findAll();
        return view('admin.banglalink-4g.devices.create', compact('tags', 'deviceTags'));
    }

    public function edit($id)
    {
        $deviceTags = $this->fourGDeviceTagService->findAll();
        $tags = $this->tagCategoryService->findAll();
        $device = $this->fourGDevicesService->findOne($id);
        return view('admin.banglalink-4g.devices.edit', compact('device','deviceTags', 'tags'));
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
