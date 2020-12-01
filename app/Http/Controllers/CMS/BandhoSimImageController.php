<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BandhoSimeImage;
use App\Services\BandhoSimImageService;

class BandhoSimImageController extends Controller
{


    /**
     * @var BandhoSimImageService
     */
    private $bandhoSimImageService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BandhoSimImageController constructor.
     * @param BandhoSimImageService $bandhoSimImageService
     */
    public function __construct(BandhoSimImageService $bandhoSimImageService)
    {
        $this->bandhoSimImageService = $bandhoSimImageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image =$this->bandhoSimImageService->findOne(1);
        return view('admin.bandhosimimage.index')
                ->with('image', $image);
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            session()->flash('message', $this->bandhoSimImageService->storeBandhoSimImage($request->all())->getContent());


        return redirect(route('bandhosim.index'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BandhoSimeImage $bandhoSimeImage)
    {

        $image =$this->bandhoSimImageService->findOne(1);
        session()->flash('success', $this->bandhoSimImageService->updateBandhoSimImage($request, $image)->getContent());
        return redirect(route('bandhosim.index'));
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
    public function edit(BandhoSimeImage $bandhoSimeImage)
    {
        //
    }
}
