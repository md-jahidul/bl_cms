<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericSlider;
use App\Services\GenericSliderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if ($flag) {
            Session::flash('success', 'Slider Created Successfully');
        } else {
            Session::flash('error', 'Slider Created Failed');
        }

        return redirect('generic-slider');
    }


    public function show(GenericSlider $genericSlider)
    {
        //
    }


    public function edit($sliderId)
    {
        $slider = $this->genericSliderService->findOne($sliderId);
        return view('admin.generic-slider.edit', compact('slider'));
    }


    public function update(Request $request, $sliderId)
    {

        $success = $this->genericSliderService->updateSlider($request->all(), $sliderId);
        if ($success) {
            Session::flash('success', 'Slider Updtaed Successfully');
        } else {
            Session::flash('error', 'Slider Updated Failed');
        }

        return redirect('generic-slider');

    }


    public function destroy($genericSliderId)
    {
        $this->genericSliderService->deleteComponent($genericSliderId);

        return url('generic-slider');
    }
}
