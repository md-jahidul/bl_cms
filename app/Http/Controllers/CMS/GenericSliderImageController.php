<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericSliderImage;
use App\Services\BaseMsisdnService;
use App\Services\GenericSliderImageService;
use App\Services\GenericSliderService;
use Illuminate\Http\Request;

class GenericSliderImageController extends Controller
{
    protected $genericSliderService;
    protected $genericSliderImagesService;
    protected $baseMsisdnService;

    public function __construct(
        GenericSliderService $genericSliderService,
        GenericSliderImageService $genericSliderImageService,
        BaseMsisdnService $baseMsisdnService
    ) {
        $this->genericSliderService = $genericSliderService;
        $this->genericSliderImagesService = $genericSliderImageService;
        $this->baseMsisdnService = $baseMsisdnService;
    }
    public function index($sliderId)
    {
        $slider = $this->genericSliderService->findOne($sliderId);
        $sliderImages = $this->genericSliderImagesService->itemList($sliderId);
//        dd($slider, $sliderImages);
        return view(
            'admin.generic-slider.images.index',
            compact('sliderId', 'slider', 'sliderImages')
        );
    }

    public function create($sliderId)
    {
        $baseGroups = $this->baseMsisdnService->findAll();
        $slider_information = $this->genericSliderService->findOne($sliderId);

        return view('admin.generic-slider.images.create', compact('sliderId', 'slider_information','baseGroups'));
    }

    public function store(Request $request)
    {
        session()->flash('message', $this->genericSliderImagesService->storeSliderImage($request->all())->getContent());
        return redirect()->back();
    }

    public function show(GenericSliderImage $genericSliderImage)
    {
        //
    }


    public function edit(GenericSliderImage $genericSliderImage)
    {
        //
    }

    public function update(Request $request, GenericSliderImage $genericSliderImage)
    {
        //
    }

    public function destroy(GenericSliderImage $genericSliderImage)
    {
        //
    }
}
