<?php

namespace App\Http\Controllers\CMS;

use App\Repositories\MyblSliderComponentTypeRepository;
use App\Services\MyblSliderComponentTypeService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
//use App\Models\SliderComponentTypes;
use App\Services\MyblSliderService;
use App\Http\Requests\MyblSliderRequest;
use Illuminate\Http\Response;

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
     * @param MyblSliderService $sliderService
     * @param MyblSliderComponentTypeService $sliderTypeService
     */
    public function __construct(MyblSliderService $sliderService, MyblSliderComponentTypeService $sliderTypeService)
    {
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sliders = $this->sliderService->getAppSlider();
        return view('admin.myblslider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.myblslider.create')
                ->with('sliders', $this->sliderService->findAll())
                ->with('slider_types', $this->sliderTypeService->findAll());
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(MyblSliderRequest $request)
    {

        session()->flash('message', $this->sliderService->storeSlider($request->all())->getContent());
        return redirect(route('myblslider.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Slider $myblslider)
    {

        return view('admin.myblslider.create')
                ->with('sliders', $this->sliderService->findAll())
                ->with('slider_types', $this->sliderTypeService->findAll())
                ->with('single_slider', $myblslider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */

    public function update(MyblSliderRequest $request, $id)
    {
        session()->flash('success', $this->sliderService->updateSlider($request, $this->sliderService->findOne($id))->getContent());
        return redirect(route('myblslider.index'));
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        //return $slider;
        session()->flash('error', $this->sliderService->deleteSlider($id)->getContent());
        return url('myblslider');
    }
}
