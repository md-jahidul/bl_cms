<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MyblSliderImageService;
use App\Http\Requests\SliderImageStoreRequest;
use App\Http\Requests\SliderImageUpdateRequest;
use App\Services\MyblSliderService;
use App\Services\AlSliderComponentTypeService;
use App\Models\SliderImage;
use Illuminate\Http\Response;

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
     * @param MyblSliderImageService $sliderImageService
     * @param MyblSliderService $sliderService
     * @param AlSliderComponentTypeService $sliderTypeService
     */
    public function __construct(MyblSliderImageService $sliderImageService, MyblSliderService $sliderService, AlSliderComponentTypeService $sliderTypeService)
    {
        $this->sliderImageService = $sliderImageService;
        $this->sliderService = $sliderService;
        $this->sliderTypeService = $sliderTypeService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param $sliderId
     * @return Response
     */
    public function index($sliderId)
    {
        $slider_information = $this->sliderService->findOne($sliderId);
        return view('admin.myblslider.images.index',compact('sliderId','slider_information'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($sliderId)
    {
        $slider_information = $this->sliderService->findOne($sliderId);
        return view('admin.myblslider.images.create',compact('sliderId','slider_information'));
    }

    /**return redirect(route('myblslider.index'));
     * Store a newly created resource in storage.
     *
     * @param SliderImageStoreRequest $request
     * @return Response
     */
    public function store(SliderImageStoreRequest $request)
    {
        session()->flash('message',$this->sliderImageService->storeSliderImage($request->all())->getContent());
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function updatePosition(Request $request)
    {
        //return $request;
        foreach ($request->position as $position) {
            $image = SliderImage::FindorFail($position[0]);
            $image->update(['sequence' => $position[1]]);
        }
        return "success";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($sliderImageId)
    {
        $imageInfo = SliderImage::find($sliderImageId);
        return view('admin.myblslider.images.edit',compact('imageInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderImageUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(SliderImageUpdateRequest $request, $id)
    {
        session()->flash('success',$this->sliderImageService->updateSliderImage($request->all(), $id)->getContent());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        session()->flash('error',$this->sliderImageService->deletesliderImage($id)->getContent());
        return redirect()->back();
    }
}
