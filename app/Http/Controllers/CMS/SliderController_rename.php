<?php

namespace App\Http\Controllers\CMS;

use App\Models\Slider;
use App\Models\SliderType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SliderControllerRename extends Controller
{
    public function index(){
        $sliders = Slider::with('sliderType')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create(){
        $slider_types = SliderType::select('id', 'name')->get();
        return view('admin.slider.create', compact('slider_types'));
    }

    public function store(Request $request){

        $slider_count = (new Slider)->get()->count();
        Slider::create([
            'title' => $request->title,
            'slider_type_id' => $request->slider_type_id,
            'description' => $request->description,
            'short_code' => ($slider_count == 0) ? "slider_1" : 'slider_'.++$slider_count
        ]);
        return redirect('sliders');
    }

    public function edit($id){
        $slider = Slider::findOrFail($id);
        $slider_types = SliderType::select('id', 'name')->get();
        return view('admin.slider.edit', compact('slider_types', 'slider'));
    }

    public function update(Request $request, $id){
        $slider = Slider::findOrFail($id);
        $slider->update($request->all());
        return redirect('sliders');
    }
}
