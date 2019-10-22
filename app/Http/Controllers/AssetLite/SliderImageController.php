<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderImageRequest;
use App\Models\AlSlider;
use App\Models\AlSliderImage;
use App\Services\AlSliderImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderImageController extends Controller
{
    /**
     * @var $alSliderImageService
     */
    private $alSliderImageService;

    /**
     * AlSliderImageController constructor.
     * @param AlSliderImageService $alSliderImageService
     */
    public function __construct(AlSliderImageService $alSliderImageService)
    {
        $this->alSliderImageService = $alSliderImageService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sliderId, $type)
    {
        $slider_images = AlSliderImage::where('slider_id', $sliderId)->with('slider')->orderBy('display_order')->get();
        $sliderItem    = AlSlider::select('title_en', 'slider_type')->where('id', $sliderId)->first();
//        $this->alSliderImageService->itemList($sliderId, $type);

//        return $sliderTitle;
        return view('admin.slider-image.index', compact('slider_images', 'sliderItem', 'sliderId','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sliderId, $type)
    {
        return view('admin.slider-image.create', compact("sliderId", 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderImageRequest $request, $sliderId, $type)
    {
        $response = $this->alSliderImageService->storeSliderImage($request->all(), $sliderId);
        Session::flash('message', $response->getContent());
        return redirect("slider/$sliderId/$type");
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
        $sliderImage = AlSliderImage::find($id);
        $other_attributes = $sliderImage->other_attributes;

//        return $other_attributes;


        return view('admin.slider-image.edit', compact('sliderImage','type', 'other_attributes'));
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
        $response = $this->alSliderImageService->updateSliderImage($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("slider/$parentId/$type");
    }

    public function sliderImageSortable(Request $request)
    {
        $this->alSliderImageService->tableSortable($request);
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

        $response = $this->alSliderImageService->deleteSliderImage($id);
        Session::flash('message', $response->getContent());
        return url("slider/$parentId/$type");
    }
}
