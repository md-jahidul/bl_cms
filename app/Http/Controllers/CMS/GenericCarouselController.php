<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericSlider;
use App\Models\LiveContent;
use App\Services\GenericCarouselService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;


class GenericCarouselController extends Controller
{
    protected  $genericCarouselService;
    public function __construct(GenericCarouselService $genericCarouselService)
    {
        $this->genericCarouselService = $genericCarouselService;

    }

    public function index()
    {
        $carouselImages = $this->genericCarouselService->getCarouselImage();
        return view('admin.generic-carousel.index', compact('carouselImages'));
    }


    public function create()
    {
        return view('admin.generic-carousel.create');
    }


    public function store(Request $request)
    {
        if($this->genericCarouselService->storeCarouseImage($request->all())) {
            session()->flash('message', 'Image Created Successfully');
        } else {
            session()->flash('error', 'Image Created Failed');
        }

        return redirect('generic-carousel');
    }


    public function show(GenericSlider $genericSlider)
    {
        //
    }


    public function edit($sliderId)
    {
        $imageInfo = $this->genericCarouselService->findOne($sliderId);

        return view('admin.generic-carousel.edit', compact('imageInfo'));
    }


    public function update(Request $request, $imageId)
    {

        if($this->genericCarouselService->updateCarouselImage($request->all(), $imageId)) {
            session()->flash('message', 'Image Updated Successfully');
        } else {
            session()->flash('error', 'Image Updated Failed');
        }

        return redirect('generic-carousel');

    }

    public function updatePosition(Request $request)
    {
        return $this->genericCarouselService->tableSortable($request);
    }


    public function destroy($imageId)
    {
        $image = $this->genericCarouselService->findOne($imageId);

        if ($image->delete()) {
            session()->flash('error', 'Image Deleted Successfully');
        } else {
            session()->flash('error', 'Image Deleted Failed');
        }

        return redirect()->back();
    }
}
