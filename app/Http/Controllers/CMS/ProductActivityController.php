<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\ProductActivityService;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Services\BannerService;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;

class ProductActivitesController extends Controller
{

    /**
     * @var BannerService
     */
    private $bannerService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;
    /**
     * @var ProductActivityService
     */
    private $activityService;

    /**
     * BannerController constructor.
     * @param ProductActivityService $activityService
     */
    public function __construct(ProductActivityService $activityService)
    {
        $this->activityService = $activityService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banner.index')->with('banners', $this->bannerService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        session()->flash('message', $this->bannerService->storeBanner($request->all())->getContent());
        return redirect(route('banner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('admin.banner.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.create')->with('banner_info', $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        session()->flash('success', $this->bannerService->updateBanner($request, $banner)->getContent());
        return redirect(route('banner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->bannerService->deleteBanner($id)->getContent());
        return url('banner');
    }
}
