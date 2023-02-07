<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\MyblOrangeClubBanner;
use App\Models\SliderImage;
use App\Services\BaseMsisdnService;
use App\Services\MyblOrangeClubBannerService;
use App\Services\MyblOrangeClubRedeemDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyblOrangeClubBannerController extends Controller
{
    private  $baseMsisdnService, $myblOrangeClubBannerService, $myblOrangeClubRedeemDetailService;

    public function __construct(
        BaseMsisdnService $baseMsisdnService,
        MyblOrangeClubBannerService $myblOrangeClubBannerService,
        MyblOrangeClubRedeemDetailService $myblOrangeClubRedeemDetailService
    ) {
        $this->baseMsisdnService = $baseMsisdnService;
        $this->myblOrangeClubBannerService = $myblOrangeClubBannerService;
        $this->myblOrangeClubRedeemDetailService = $myblOrangeClubRedeemDetailService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $orangeClubImages = $this->myblOrangeClubBannerService->findAll(null, null,  $orderBy);

        return view('admin.orange-club-images.index', compact('orangeClubImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $redeemDetail = $this->myblOrangeClubRedeemDetailService->first();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view('admin.orange-club-images.create', compact('baseMsisdnGroups', 'redeemDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->myblOrangeClubBannerService->save($request->all())) {
            Session::flash('message', 'Image store successful');
        }
        else{
            Session::flash('danger', 'Image Stored Failed');
        }

        return redirect('orange-club');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyblOrangeClubBanner  $myblOrangeClubBanner
     * @return \Illuminate\Http\Response
     */
    public function show(MyblOrangeClubBanner $myblOrangeClubBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyblOrangeClubBanner  $myblOrangeClubBanner
     * @return \Illuminate\Http\Response
     */
    public function edit($myblOrangeClubBannerId)
    {
        $orangeClubImage = $this->myblOrangeClubBannerService->findOne($myblOrangeClubBannerId);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $redeemDetail = $this->myblOrangeClubRedeemDetailService->first();
//        dd( $orangeClubImage->start_time);
        return view('admin.orange-club-images.edit', compact('baseMsisdnGroups', 'orangeClubImage', 'redeemDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyblOrangeClubBanner  $myblOrangeClubBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $orangeClubBaneerId)
    {
        if ($this->myblOrangeClubBannerService->update($orangeClubBaneerId, $request->all())) {
            Session::flash('message', 'Image Update successful');
        }
        else{
            Session::flash('danger', 'Image Update Failed');
        }

        return redirect('orange-club');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyblOrangeClubBanner  $myblOrangeClubBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy($myblOrangeClubBannerId)
    {
        $this->myblOrangeClubBannerService->delete($myblOrangeClubBannerId);
        return redirect('orange-club');
    }

    public function updatePosition(Request $request)
    {
        return $this->myblOrangeClubBannerService->updateOrdering($request);
    }
}
