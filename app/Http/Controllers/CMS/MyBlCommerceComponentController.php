<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\MyBlCommerceComponentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MyBlCommerceComponentController extends Controller
{
    private $componentService;

    public function __construct(
        MyBlCommerceComponentService $componentService
    ) {
        $this->componentService = $componentService;
    }


    public function index()
    {
        $components = $this->componentService->findAllComponents();
        $candidateChildes = Helper::findCandidateChildComponent($components);

        return view('admin.commerce.components', compact('components', 'candidateChildes'));
    }

    public function store(Request $request)
    {

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
            $response = $this->componentService->storeComponent($request->all());
            Session::flash('success', $response->getContent());
        }

        return redirect()->route('mybl.commerce.components');
    }

    public function componentStatusUpdate($id)
    {
        $response = $this->componentService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('mybl.commerce.components');
    }

    public function componentSort(Request $request)
    {
        return $this->componentService->tableSort($request);
    }

    public function edit($id)
    {
        $componentData =  $this->componentService->editComponent($id);
        $candidateChildes = $this->componentService->findBy(['type' => 'parent']);
        $routeObj = [
            'update' => "mybl.commerce.components.update",
            'componentName' => 'Commerce',
            'index' => 'mybl.commerce.components'
        ];

        return view('admin.mybl-home-components.generic-field', compact('componentData', 'candidateChildes', 'routeObj'));
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

        if ($validate->fails()) {
            Session::flash('error', 'Component update Faild');
        }else{
            $response = $this->componentService->updateComponent($request->all());
            Session::flash('message', $response->getContent());
        }

        return redirect()->route('mybl.commerce.components');
    }


    public function destroy($id)
    {
        $this->componentService->deleteComponent($id);
        return url(route('mybl.commerce.components'));
    }
}
