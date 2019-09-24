<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderImageRequest;
use App\Models\Slider;
use App\Models\SliderImage;
use App\Services\SliderImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderImageController extends Controller
{
    /**
     * @var $sliderImageService
     */
    private $sliderImageService;

    /**
     * SliderImageController constructor.
     * @param SliderImageService $sliderImageService
     */
    public function __construct(SliderImageService $sliderImageService)
    {
        $this->sliderImageService = $sliderImageService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sliderId, $type)
    {
        $slider_images = SliderImage::where('slider_id', $sliderId)->with('slider-other-attr')->orderBy('sequence')->get();
        $sliderTitle = Slider::where('id', $sliderId)->pluck('title')->first();
        $this->sliderImageService->itemList($sliderId, $type);
        return view('admin.slider-other-attr-image.index', compact('slider_images', 'sliderTitle', 'sliderId','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sliderId, $type)
    {
        return view('admin.slider-other-attr-image.create', compact("sliderId", 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderImageRequest $request, $sliderId, $type)
    {
        $response = $this->sliderImageService->storeSliderImage($request->all(), $sliderId);
        Session::flash('message', $response->getContent());
        return redirect("slider-other-attr/$sliderId/$type");
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
    public function edit($parentId, $type, $id)
    {
        $sliderImage = SliderImage::findOrFail($id);
        $other_attributes = $sliderImage->other_attributes;
        return view('admin.slider-other-attr-image.edit', compact('sliderImage','type', 'other_attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSliderImageRequest $request, $parentId, $type, $id)
    {
        $response = $this->sliderImageService->updateSliderImage($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("slider-other-attr/$parentId/$type");
    }

    public function sliderImageSortable(Request $request)
    {
        $this->sliderImageService->tableSortable($request);
    }

    /**
     * @param $parentId
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($parentId, $type, $id)
    {

        $response = $this->sliderImageService->deleteSliderImage($id);
        Session::flash('message', $response->getContent());


//        $slider-other-attr = SliderImage::findOrFail($id);
//        $slider-other-attr->delete();
        return url("slider-other-attr/$parentId/$type");
    }
}
