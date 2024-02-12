<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Services\GenericComponentItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GenericComponentItemController extends Controller
{
    public $genericComponentItemService;
    public function __construct(GenericComponentItemService $genericComponentItemService)
    {
        $this->genericComponentItemService= $genericComponentItemService;
    }

    public function index($id)
    {
        $components = $this->genericComponentItemService->findAllItems($id);

        return view('admin.generic-component-items.index', compact('components', 'id'));


    }


    public function store(Request $request)
    {
        $data = $request->all();
        $genericSliderId = $data['generic_component_id'];

        $validate = Validator::make(
            $request->all(),
            [
                'android_version_code' => 'nullable|regex:/^\d+-\d+$/',
                'ios_version_code' => 'nullable|regex:/^\d+-\d+$/',
            ]
        );

        if ($validate->fails()) {
            Session::flash('error', 'Component update Faild');
        }else{
            $response = $this->genericComponentItemService->storeComponent($data);
            Session::flash('success', $response->getContent());
        }

        return redirect()->route('generic-component-items-list.index', $genericSliderId);
    }

    public function componentStatusUpdate($id)
    {
        $component = $this->genericComponentItemService->findOne($id);
        $response = $this->genericComponentItemService->changeStatus($id);

        Session::flash('success', $response->getContent());
        return redirect()->route('generic-component-items-list.index', $component['generic_component_id']);
    }

    public function componentSort(Request $request)
    {
        return $this->genericComponentItemService->tableSort($request);
    }

    public function edit($id)
    {
        return $this->genericComponentItemService->editComponent($id);
    }

    public function update(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'android_version_code' => 'nullable|regex:/^\d+-\d+$/',
                'ios_version_code' => 'nullable|regex:/^\d+-\d+$/',
            ]
        );

        $data = $request->all();
        $genericSliderId = $data['generic_component_id'];

        if ($validate->fails()) {
            Session::flash('error', 'Component update Faild');
        } else {
            $response = $this->genericComponentItemService->updateComponent($data);
            Session::flash('message', $response->getContent());
        }


        return redirect()->route('generic-component-items-list.index', $genericSliderId);
    }

    public function destroy($id)
    {
        $component = $this->genericComponentItemService->findOne($id);
        $this->genericComponentItemService->deleteComponent($id);

        return url(route('generic-component-items-list.index', $component['generic_component_id']));
    }
}
