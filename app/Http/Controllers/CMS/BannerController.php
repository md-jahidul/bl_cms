<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Services\BannerService;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;

class BannerController extends Controller
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
     * BannerController constructor.
     * @param BannerService $bannerService
     */
    public function __construct(bannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banner.index')->with('banners',$this->bannerService->findAll());
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
        session()->flash('status',$this->bannerService->storeBanner($request->all())->getContent());
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
    public function update(BannerUpdateRequest $request,Banner $banner)
    { 
        session()->flash('status',$this->bannerService->updateBanner($request, $banner)->getContent());
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
        session()->flash('danger',$this->bannerService->deleteBanner($id)->getContent());
        return redirect(route('banner.index'));
    }
}
