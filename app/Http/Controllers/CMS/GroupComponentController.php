<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\GenericShortcutMasterService;
use App\Services\MyBlCommerceComponentService;
use App\Services\GenericSliderService;
use App\Services\GroupComponentService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GroupComponentController extends Controller
{
    private $genericSliderService;
    private $genericShortcutMasterService;
    private $shorcutService;
    private $componentService;

    public function __construct(
        GenericSliderService $genericSliderService,
        GenericShortcutMasterService $genericShortcutMasterService,
        GroupComponentService $componentService
    ) {
        $this->genericShortcutMasterService = $genericShortcutMasterService;
        $this->genericSliderService = $genericSliderService;
        $this->componentService = $componentService;
    }

    public function index()
    {
        $components = $this->componentService->findAllComponents();
        return view('admin.group-components.components', compact('components'));
    }

    public function create()
    {
        $sliders = $this->genericSliderService->getSlider()->toArray();
        $sliders = array_map(function($item) {
            $item['prefix'] = 'generic_slider';
            return $item;
        }, $sliders);

        $shortcuts = $this->genericShortcutMasterService->findAll()->toArray();
        $shortcuts = array_map(function($item) {
            $item['prefix'] = 'generic_shortcut';
            return $item;
        }, $shortcuts);

        $components = [ ...$sliders, ...$shortcuts];

        return view('admin.group-components.create', compact('components'));
    }

    public function store(Request $request)
    {
        // $response = $this->genericSliderService->storeSlider($request->all(), $group);
        $success = $this->componentService->storeComponent($request->all());

        if($success) {
            Session::flash('success', "Save Successful");
            return redirect()->route('group.components');
        }
        return redirect()->route('group.components')->with('error', 'Failed');
    }

    public function componentStatusUpdate($id)
    {
        $response = $this->componentService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('group.components');
    }

    public function componentSort(Request $request)
    {
        return $this->componentService->tableSort($request);
    }

    public function edit($id)
    {
        $component = $this->componentService->findOne($id);

        $sliders = $this->genericSliderService->getSlider()->toArray();
        $sliders = array_map(function($item) {
            $item['prefix'] = 'generic_slider';
            return $item;
        }, $sliders);

        $shortcuts = $this->genericShortcutMasterService->findAll()->toArray();
        $shortcuts = array_map(function($item) {
            $item['prefix'] = 'generic_shortcut';
            return $item;
        }, $shortcuts);

        $components = [...$sliders, ...$shortcuts];

        return view('admin.group-components.edit', compact('component', 'components'));
    }

    public function update(Request $request, $id)
    {
        $success = $this->componentService->updateComponent($request->all(), $id);

        if($success) {
            Session::flash('success', "Update Successful");
            return redirect()->route('group.components');
        }
        return redirect()->route('group.components')->with('error', 'Failed');
    }

    public function destroy($id)
    {
        $success = $this->componentService->deleteComponent($id);

        if($success) {
            Session::flash('success', "Delete Successful");
            return redirect()->route('group.components');
        }
        return redirect()->route('group.components')->with('error', 'Failed');
    }
}
