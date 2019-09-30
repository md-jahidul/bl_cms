<?php

namespace App\Http\Controllers\CMS;

use App\Repositories\MyblSliderComponentTypeRepository;
use App\Services\MyblSliderComponentTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
//use App\Models\SliderComponentTypes;
use App\Services\MyblSliderService;

use App\Http\Requests\MyblSliderRequest;
class MyblSliderController extends Controller
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
    public function __construct(MyblSliderService $sliderService, MyblSliderComponentTypeService $sliderTypeService)
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
        $sliders = $this->sliderService->getAppSlider();
        $slider_types = $this->sliderTypeService->findAll();
        //dd($sliders);
        return view('admin.myblslider.index')
                ->with('sliders',$sliders)
                ->with('slider_types',$slider_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.myblslider.create')
                ->with('sliders',$this->sliderService->findAll())
                ->with('slider_types',$this->sliderTypeService->findAll());;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyblSliderRequest $request)
    {
        
        session()->flash('message',$this->sliderService->storeSlider($request->all())->getContent());
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $myblslider)
    {

        return view('admin.myblslider.create')
                ->with('sliders',$this->sliderService->findAll())
                ->with('slider_types',$this->sliderTypeService->findAll())
                ->with('single_slider',$myblslider);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(MyblSliderRequest $request,$id)
    {
        session()->flash('success',$this->sliderService->updateSlider($request, $this->sliderService->findOne($id))->getContent());
        return redirect(route('myblslider.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        //return $slider;
        session()->flash('error',$this->sliderService->deleteSlider($id)->getContent());
        return url('myblslider');
    }
}
