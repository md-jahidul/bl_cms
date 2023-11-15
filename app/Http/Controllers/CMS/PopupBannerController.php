<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PopupBanner;
use App\Services\PopupBannerService;
use Illuminate\Http\Response;

class PopupBannerController extends Controller
{
    /**
     * @var popupBannerService
     */
    protected $popupBannerService;

    /**
     * OtpController constructor.
     * @param PopupBannerService $otpService
     */
    public function __construct(PopupBannerService $popupBannerService)
    {
        $this->popupBannerService = $popupBannerService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $allBanner = $this->popupBannerService->getPopupBanner();
        return view('admin.popup-banner.index')
            ->with('banners', $allBanner);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function bannerSortable(Request $request)
    {
        return $this->popupBannerService->tableSort($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.popup-banner.create')->with('page','create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response =  $this->popupBannerService->createBanner($request);

        if ($response) {
            session()->flash('success', "Created successfully");
        }else{
            session()->flash('message', "Failed! Please try again");
        }
        return redirect(route('popup-banner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = $this->popupBannerService->findBanner($id);
        $banner['start_time'] = $banner['start_date'];
        return view('admin.popup-banner.edit')->with('page','edit')->with('banner',$banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $response =  $this->popupBannerService->updateBanner($request, $id);
        if ($response) {
            session()->flash('success', "Updated successfully");
        }else{
            session()->flash('message', "Failed! Please try again");
        }
        return redirect(route('popup-banner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $response = $this->popupBannerService->deleteBanner($id);

        if ($response) {
            session()->flash('error', "Deleted successfully");
        }else{
            session()->flash('message', "Failed! Please try again");
        }
        return redirect(route('popup-banner.index'));
    }
}
