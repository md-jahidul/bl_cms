<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericSliderImage;
use App\Models\SliderImage;
use App\Services\BaseMsisdnService;
use App\Services\FeedCategoryService;
use App\Services\GenericSliderImageService;
use App\Services\GenericSliderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GenericSliderImageController extends Controller
{
    protected $genericSliderService;
    protected $genericSliderImagesService;
    protected $baseMsisdnService;
    protected $feedCategoryService;

    public function __construct(
        GenericSliderService $genericSliderService,
        GenericSliderImageService $genericSliderImageService,
        BaseMsisdnService $baseMsisdnService,
        FeedCategoryService $feedCategoryService
    ) {
        $this->genericSliderService = $genericSliderService;
        $this->genericSliderImagesService = $genericSliderImageService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->feedCategoryService = $feedCategoryService;
    }
    public function index($sliderId)
    {
        $slider = $this->genericSliderService->findOne($sliderId);
        $sliderImages = $this->genericSliderImagesService->itemList($sliderId);

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
        if($this->genericSliderImagesService->storeSliderImage($request->all())) {
            session()->flash('message', 'Image Created Successfully');
        } else {
            session()->flash('error', 'Image Created Failed');
        }

        return redirect()->back();
    }

    public function updatePosition(Request $request)
    {
        foreach ($request->position as $position) {
            $image = GenericSliderImage::FindorFail($position[0]);
            $image->update(['sequence' => $position[1]]);
        }

        Redis::del('mybl_home_component');
        Redis::del('content_component');
        Redis::del('non_bl_component');
        Redis::del('mybl_commerce_component');
        return "success";
    }

    public function show(GenericSliderImage $genericSliderImage)
    {
        //
    }


    public function edit($imageId)
    {
        $imageInfo = $this->genericSliderImagesService->findOne($imageId);
        $products  = $this->genericSliderImagesService->getActiveProducts();
        $baseGroups = $this->baseMsisdnService->findAll();
        $feedCategories = $this->feedCategoryService->findAll();

        return view('admin.generic-slider.images.edit', compact('imageInfo', 'products', 'baseGroups', 'feedCategories'));
    }

    public function update(Request $request, $imageId)
    {
        if($this->genericSliderImagesService->updateSliderImage($request->all(), $imageId)) {
            session()->flash('message', 'Image Updated Successfully');
        } else {
            session()->flash('error', 'Image Updated Failed');
        }

        return redirect()->back();
    }

    public function destroy($imageId)
    {
        $image = $this->genericSliderImagesService->findOne($imageId);

        if ($image->delete()) {
            session()->flash('error', 'Image Deleted Successfully');
        } else {
            session()->flash('error', 'Image Deleted Failed');
        }

        return redirect()->back();
    }
}
