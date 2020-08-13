<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\FourGDeviceTagService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class FourGDeviceTagController extends Controller
{
    /**
     * @var FourGDeviceTagService
     */
    private $fourGDeviceTagService;

    /**
     * TagController constructor.
     * @param FourGDeviceTagService $fourGDeviceTagService
     */
    public function __construct(FourGDeviceTagService $fourGDeviceTagService)
    {
        $this->fourGDeviceTagService = $fourGDeviceTagService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $tags = $this->fourGDeviceTagService->findAll();
        return view('admin.banglalink-4g.device-tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.banglalink-4g.device-tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->fourGDeviceTagService->storeTagCategory($request->all());
        Session::flash('success', $response->getContent());
        return redirect('/bl-4g-device-tag');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $tag = $this->fourGDeviceTagService->findOne($id);
        return view('admin.banglalink-4g.device-tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->fourGDeviceTagService->updateTagCategory($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-4g-device-tag');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->fourGDeviceTagService->deleteTagCategory($id);
        Session::flash('message', $response->getContent());
        return url('/bl-4g-device-tag');
    }
}
