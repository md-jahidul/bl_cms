<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderImageRequest;
use App\Models\AlSlider;
use App\Models\AlSliderImage;
use App\Services\AlSliderImageService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;

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
     * @return Response
     */
    public function index($sliderId, $type)
    {
        $previousUrl = url()->previous();
        $slider_images = AlSliderImage::where('slider_id', $sliderId)->with('slider')->orderBy('display_order')->get();
        $sliderItem    = AlSlider::select('title_en', 'slider_type')->where('id', $sliderId)->first();
        return view('admin.slider-image.index', compact('slider_images', 'sliderItem', 'sliderId', 'type', 'previousUrl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($sliderId, $type)
    {
        return view('admin.slider-image.create', compact("sliderId", 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
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
    public function edit($parentId, $type, $id)
    {
        $sliderImage = $this->alSliderImageService->findOne($id);
        $other_attributes = $sliderImage->other_attributes;
        return view('admin.slider-image.edit', compact('sliderImage', 'type', 'other_attributes'));
    }


    /**
     * @param StoreSliderImageRequest $request
     * @param $parentId
     * @param $type
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(StoreSliderImageRequest $request, $parentId, $type, $id)
    {
        // TODO: Done:check file size validation
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
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($parentId, $type, $id)
    {
        $response = $this->alSliderImageService->deleteSliderImage($id);
        Session::flash('message', $response->getContent());
        return url("slider/$parentId/$type");
    }
}
