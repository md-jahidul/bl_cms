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
        return view('admin.generic-slider.index', compact('sliders'));
    }


    public function create()
    {
        return view('admin.generic-slider.create');
    }


    public function store(Request $request)
    {
        $flag = $this->genericSliderService->storeSlider($request->all());

        return redirect('generic-slider');
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


    public function destroy($genericSliderId)
    {
        $this->genericSliderService->deleteComponent($genericSliderId);

        return url('generic-slider');
    }
}
