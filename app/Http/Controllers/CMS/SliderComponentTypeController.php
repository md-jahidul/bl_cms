<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\MyblSliderComponentTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderComponentTypeController extends Controller
{
    protected  $myblSliderComponentTypeService;

    public function __construct(MyblSliderComponentTypeService $myblSliderComponentTypeService)
    {
        $this->myblSliderComponentTypeService = $myblSliderComponentTypeService;
    }

    public function index()
    {
        $sliderComponentTypes = $this->myblSliderComponentTypeService->findAll();
        return view('admin.slider-component-types.index', compact('sliderComponentTypes'));
    }


    public function create()
    {
        return view('admin.slider-component-types.create');
    }


    public function store(Request $request)
    {
        if ($this->myblSliderComponentTypeService->save($request->all())) {
            Session::flash('message', 'Slider Component Type store successful');
        }
        else{
            Session::flash('danger', 'Slider Component Type Stored Failed');
        }

        return redirect('slider-component-types');
    }

    public function edit($myBlCampaignSectionId)
    {
        $section = $this->myblSliderComponentTypeService->findOne($myBlCampaignSectionId);

        return view('admin.slider-component-types.edit', compact('section'));
    }


    public function update(Request $request,  $myBlCampaignSectionId)
    {
        if ($this->myblSliderComponentTypeService->update($myBlCampaignSectionId, $request->all())) {
            Session::flash('message', 'Slider Component Type Update successful');
        }
        else{
            Session::flash('danger', 'Slider Component Type Update Failed');
        }

        return redirect('slider-component-types');
    }

    public function destroy($myBlCampaignSectionId)
    {
        $this->myblSliderComponentTypeService->delete($myBlCampaignSectionId);
        return redirect('slider-component-types');
    }
}
