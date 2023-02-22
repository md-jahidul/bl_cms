<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\MyblOrangeClubRedeemDetail;
use App\Repositories\MyblOrangeClubRedeemDetailRepository;
use App\Services\MyblOrangeClubRedeemDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyblOrangeClubRedeemDetailController extends Controller
{
    private  $myblOrangeClubRedeemDetailService;

    public function __construct(
        MyblOrangeClubRedeemDetailService $myblOrangeClubRedeemDetailService
    ) {
        $this->myblOrangeClubRedeemDetailService = $myblOrangeClubRedeemDetailService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redeemDetail = $this->myblOrangeClubRedeemDetailService->first();

        return view('admin.orange-club-images.redeem-index', compact('redeemDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->myblOrangeClubRedeemDetailService->save($request->all())) {
            Session::flash('message', 'Image store successful');
        }
        else{
            Session::flash('danger', 'Image Stored Failed');
        }

        return redirect('orange-club-redeem');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyblOrangeClubRedeemDetail  $myblOrangeClubRedeemDetail
     * @return \Illuminate\Http\Response
     */
    public function show(MyblOrangeClubRedeemDetail $myblOrangeClubRedeemDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyblOrangeClubRedeemDetail  $myblOrangeClubRedeemDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(MyblOrangeClubRedeemDetail $myblOrangeClubRedeemDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyblOrangeClubRedeemDetail  $myblOrangeClubRedeemDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $myblOrangeClubRedeemDetailId)
    {
        if ($this->myblOrangeClubRedeemDetailService->update($myblOrangeClubRedeemDetailId, $request->all())) {
            Session::flash('message', 'Image Update successful');
        }
        else{
            Session::flash('danger', 'Image Update Failed');
        }

        return redirect('orange-club-redeem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyblOrangeClubRedeemDetail  $myblOrangeClubRedeemDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyblOrangeClubRedeemDetail $myblOrangeClubRedeemDetail)
    {
        //
    }
}
