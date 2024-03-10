<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericSlider;
use App\Services\GenericComponentService;
use App\Services\GenericSliderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VeonAdTechController extends Controller
{
    protected  $genericSliderService;
    protected $genericComponentService;
    public function __construct(
        GenericSliderService $genericSliderService,
        GenericComponentService $genericComponentService
    ) {
        $this->genericSliderService = $genericSliderService;
        $this->genericComponentService = $genericComponentService;
    }

    public function index()
    {
        $sliders = $this->genericSliderService->findBy(['component_type' => 'ad_inventory', 'status' => 1]);
        return view('admin.veon-adtech.index', compact('sliders'));
    }


    public function create()
    {

        $config = config('generic-slider.component_for');
        $genericComponent = $this->genericComponentService->findAll();
        $genericComponent = $genericComponent->pluck('title_en', 'component_key')->toArray();
        $componentType = array_merge($config, $genericComponent);

        return view('admin.veon-adtech.create', compact('componentType'));
    }


    public function store(Request $request)
    {
        $flag = $this->genericSliderService->storeSlider($request->all());

        if($request->input('component_type') != 'carousel') {
            $request->merge([
                'scrollable' => false,
            ]);
        }

        if ($flag) {
            Session::flash('success', 'Slider Created Successfully');
        } else {
            Session::flash('error', 'Slider Created Failed');
        }

        return redirect('veon-adtech');
    }


    public function show(GenericSlider $genericSlider)
    {
        //
    }


    public function edit($sliderId)
    {
        $slider = $this->genericSliderService->findOne($sliderId);

        $android_version_code = implode('-', [$slider['android_version_code_min'], $slider['android_version_code_max']]);
        $ios_version_code = implode('-', [$slider['ios_version_code_min'], $slider['ios_version_code_max']]);
        $slider->android_version_code = $android_version_code;
        $slider->ios_version_code = $ios_version_code;

        $config = config('generic-slider.component_for');
        $genericComponent = $this->genericComponentService->findAll();
        $genericComponent = $genericComponent->pluck('title_en', 'component_key')->toArray();
        $componentType = array_merge($config, $genericComponent);

        return view('admin.veon-adtech.edit', compact('slider', 'componentType'));
    }


    public function update(Request $request, $sliderId)
    {
        if($request->input('component_type') != 'carousel' && $request->input('component_type') != null) {
            $request->merge([
                'scrollable' => false,
            ]);
        }
        $success = $this->genericSliderService->updateSlider($request->all(), $sliderId);
        if ($success) {
            Session::flash('success', 'Slider Updtaed Successfully');
        } else {
            Session::flash('error', 'Slider Updated Failed');
        }

        return redirect('veon-adtech');
    }


    public function destroy($genericSliderId)
    {
        $this->genericSliderService->deleteComponent($genericSliderId);

        return url('veon-adtech');
    }
}
