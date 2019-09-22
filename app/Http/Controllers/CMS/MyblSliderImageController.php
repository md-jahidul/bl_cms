<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MyblSliderImageService;
use App\Http\Requests\SliderImageStoreRequest;
use App\Http\Requests\SliderImageUpdateRequest;
use App\Services\MyblSliderService;
use App\Services\SliderTypeService;
use App\Models\SliderImage;

class MyblSliderImageController extends Controller
{

     /**
     * @var SliderService
     */
    private $sliderImageService;
    private $sliderService;
    private $sliderTypeService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param SliderImageService $sliderService
     */
    public function __construct(MyblSliderImageService $sliderImageService,MyblSliderService $sliderService,SliderTypeService $sliderTypeService)
    {
        $this->sliderImageService = $sliderImageService;
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sliderId)
    {
        
        return view('admin.myblslider.add_image_to_slider')
                    ->with('sliderId',$sliderId)
                    ->with('slider_information',$this->sliderService->findOne($sliderId));
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
    public function store(SliderImageStoreRequest $request)
    {
        session()->flash('success',$this->sliderImageService->storeSliderImage($request->all()['repeater-list'])->getContent());
        return redirect(route('myblslider.index'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request)
    {
        //return $request;
        foreach ($request->positions as $position) {
            $image = SliderImage::FindorFail($position[0]);
            $image->update(['sequence' => $position[1]]);
        } 
        return "success";
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->sliderService->findOne($id);
        return view('admin.myblslider.edit_image_to_slider')
                ->with('slider',$slider)
                ->with('slider_information',$this->sliderService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderImageUpdateRequest $request, $id)
    {
        //dd( $request, $id);
        session()->flash('success',$this->sliderImageService->updateSliderImage($request->all(), $id)->getContent());
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
        //dd($id);
        session()->flash('danger',$this->sliderImageService->deletesliderImage($id)->getContent());
        return redirect()->back();
    }
}
