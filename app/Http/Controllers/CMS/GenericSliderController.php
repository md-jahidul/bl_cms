<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericSlider;
use App\Services\GenericSliderService;
use Illuminate\Http\Request;

class GenericSliderController extends Controller
{
    protected  $genericSliderService;
    public function __construct(GenericSliderService $genericSliderService)
    {
        $this->genericSliderService = $genericSliderService;

    }

    public function index()
    {
        $sliders = $this->genericSliderService->getSlider();
        dd($sliders->sliderImage);
        return view('admin.generic-slider.index', compact('sliders'));
    }


    public function create()
    {
        return view('admin.generic-slider.create');
    }


    public function store(Request $request)
    {
        $flag = $this->genericSliderService->storeSlider($request->all());
        dd($flag);
    }


    public function show(GenericSlider $genericSlider)
    {
        //
    }


    public function edit(GenericSlider $genericSlider)
    {
        //
    }


    public function update(Request $request, GenericSlider $genericSlider)
    {
        //
    }


    public function destroy(GenericSlider $genericSlider)
    {
        //
    }
}
