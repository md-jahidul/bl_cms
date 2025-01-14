<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Services\DynamicRouteService;
use App\Services\MetaTagService;
use App\Services\MyblHomeComponentService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ShortCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MyblHomeComponentController extends Controller
{


    /**
     * @var MyblHomeComponentService
     */
    private $componentService;

    /**
     * MyblHomeComponentController constructor.
     * @param MyblHomeComponentService $componentService
     */
    public function __construct(
        MyblHomeComponentService $componentService
    ) {
        $this->componentService = $componentService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $components = $this->componentService->findAllComponents();
        $candidateChildes = Helper::findCandidateChildComponent($components);

        return view('admin.mybl-home-components.index', compact('components', 'candidateChildes'));
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

        return redirect()->route('mybl.home.components');
    }

    public function componentStatusUpdate($id)
    {
        $response = $this->componentService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('mybl.home.components');
    }

    public function componentSort(Request $request)
    {
        return $this->componentService->tableSort($request);
    }

    public function edit($id)
    {

        $componentData = $this->componentService->editComponent($id);
        $candidateChildes = $this->componentService->findBy(['type' => 'parent']);
        $routeObj = [
            'update' => "mybl.home.components.update",
            'componentName' => 'Home',
            'index' => 'mybl.home.components'
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


        return redirect()->route('mybl.home.components');
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Application|UrlGenerator|string
     */
    public function destroy($id)
    {
        $this->componentService->deleteComponent($id);
        return url(route('mybl.home.components'));
    }
}
