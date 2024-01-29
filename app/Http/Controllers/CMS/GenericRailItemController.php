<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\GenericRailItem;
use App\Models\GenericSliderImage;
use App\Services\GenericRailItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GenericRailItemController extends Controller
{
    public $genericRailItemService;

    public function __construct(GenericRailItemService $genericRailItemService)
    {
        $this->genericRailItemService = $genericRailItemService;
    }
    public function index($railId)
    {
        $railItems = $this->genericRailItemService->itemList($railId);

        return view(
            'admin.generic-rail.items.index',
            compact('railId', 'railItems')
        );
    }

    public function create($railId)
    {
        return view('admin.generic-rail.items.create', compact('railId'));
    }

    public function store(Request $request)
    {
        if($this->genericRailItemService->storeItem($request->all())) {
            session()->flash('message', 'Item Created Successfully');
        } else {
            session()->flash('error', 'Item Created Failed');
        }

        return redirect()->back();
    }

    public function updatePosition(Request $request)
    {
        foreach ($request->position as $position) {
            $image =  $this->genericRailItemService->findOrFail($position[0]);
            $image->update(['display_order' => $position[1]]);
        }

        Helper::removeVersionControlRedisKey();
        Redis::del('generic_rail_data');

        return "success";
    }

    public function show(GenericSliderImage $genericSliderImage)
    {
        //
    }


    public function edit($itemId)
    {
        $itemData = $this->genericRailItemService->findOne($itemId);
        $android_version_code = implode('-', [$itemData['android_version_code_min'], $itemData['android_version_code_max']]);
        $ios_version_code = implode('-', [$itemData['ios_version_code_min'], $itemData['ios_version_code_max']]);
        $itemData->android_version_code = $android_version_code;
        $itemData->ios_version_code = $ios_version_code;

        return view('admin.generic-rail.items.edit', compact('itemData'));
    }

    public function update(Request $request, $itemId)
    {
        if($this->genericRailItemService->update($request->all(), $itemId)) {

            session()->flash('message', 'Item Updated Successfully');
        } else {
            session()->flash('error', 'Item Updated Failed');
        }

        return redirect()->back();
    }

    public function destroy($itemId)
    {
        $railId = $this->genericRailItemService->deleteItem($itemId);

        return route('generic-rail.items.index', ['rail_id' => $railId]);
    }
}
