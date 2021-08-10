<?php

namespace App\Http\Controllers\CMS;

use App\Services\DynamicRouteService;
use App\Services\MetaTagService;
use App\Services\MyblHomeComponentService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ShortCode;
use Illuminate\Support\Facades\Session;

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
//        return $components;
        return view('admin.mybl-home-components.index', compact('components'));
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
        return $this->componentService->findOne($id);
    }

    public function update(Request $request)
    {
        $response = $this->componentService->updateComponent($request->all());
        Session::flash('massage', $response->getContent());
        return redirect()->route('mybl.home.components');
    }
}
