<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderType;
use App\Services\SliderService;
use App\Services\SliderTypeService;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{

     /**
     * @var SliderService
     */
    private $sliderService;
    private $sliderTypeService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService,SliderTypeService $sliderTypeService)
    {
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slider.index')
                ->with('sliders',$this->sliderService->findAll())
                ->with('slider_types',$this->sliderTypeService->findAll());
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
    public function store(SliderRequest $request)
    {
        session()->flash('status',$this->sliderService->storeSlider($request->all())->getContent());
        return redirect(route('slider.index'));
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
    public function edit(Slider $slider)
    {
        return view('admin.slider.index')
                ->with('sliders',$this->sliderService->findAll())
                ->with('slider_types',$this->sliderTypeService->findAll())
                ->with('single_slider',$slider);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request,Slider $slider)
    {
        session()->flash('status',$this->sliderService->updateSlider($request, $slider)->getContent());
        return redirect(route('slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $slider;
        session()->flash('danger',$this->sliderService->deleteSlider($id)->getContent());
        return redirect(route('slider.index'));
    }
}
