<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Assetlite\ComponentService;

class ExploreCDetailsController extends Controller
{
    
    protected $componentService;
    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }


    public function componentCreate()
    {
        $componentList = ComponentHelper::components();
        return view('admin.components.create', compact('componentList'));
    }

    public function componentStore(Request $request)
    {
        $response = $this->componentService->componentStore($request->all(), 0, self::PAGE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('about-page/priyojon');
    }

    public function componentEdit(Request $request)
    {
        $response = $this->componentService->componentStore($request->all(), 0, self::PAGE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('about-page/priyojon');
    }



}
