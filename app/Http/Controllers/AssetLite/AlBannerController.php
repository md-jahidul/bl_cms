<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AlBannerService;
use Illuminate\Support\Facades\Session;

class AlBannerController extends Controller
{
    
    protected $alBannerService;

    public function __construct(AlBannerService $alBannerService)
    {
        $this->alBannerService = $alBannerService;
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->alBannerService->findBy(['section_id' => 0]);

        return view('admin.al-banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.al-banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $response = $this->alBannerService->alBannerStore($request->all());
        Session::flash('message', $response->getContent());

        if ($request->from_generic == true) 
        {
            return redirect('al-banner');
        }
        return redirect()->back();
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
        $banner = $this->alBannerService->findOne($id);
        return view('admin.al-banner.create', compact('banner'));
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
        // return $request->all();

        $response = $this->alBannerService->alBannerUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        
        if ($request->from_generic == true) 
        {
            return redirect('al-banner');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if ($this->alBannerService->delete($id)) {
        //     $message = "Successfully Deleted";
        //     $type = 'success';
        //     $code = 200;
        // } else {
        //     $message = "Error! Not Deleted";
        //     $type = 'error';
        //     $code = 500;
        // }
    }
}
