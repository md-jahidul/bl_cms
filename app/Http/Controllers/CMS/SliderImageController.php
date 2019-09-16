<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderImage;
use Illuminate\Http\Request;

class SliderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parentId,$type)
    {
        $slider_images = SliderImage::where('slider_id', $parentId)->with('slider')->get();
        return view('admin.slider-image.index', compact('slider_images','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sliders = Slider::select('id', 'title')->get();
        $type = 'degital_services';

        return view('admin.slider-image.create', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slider_data = $request->all();
        $file_name = str_replace(' ', '_', $request->title);
        $upload_date = date('d_m_Y_h_i_s');

        $sliderImage = $request->file('image_url');
        $fileType = $sliderImage->getClientOriginalExtension();
        $imageName = $file_name .'_'.$upload_date.'.' . $fileType;
        $directory = 'slider-images/';
        $imageUrl = $imageName;
        $sliderImage->move($directory, $imageName);

        $slider_data['image_url'] = $imageUrl;
        SliderImage::create($slider_data);

        return redirect('slider_image');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$type)
    {
        $sliderImage = SliderImage::findOrFail($id);
        return view('admin.slider-image.edit', compact('sliderImage','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $slider_data = $request->all();

//        return $slider_data;

        if (!empty($request->image_url)){
            $file_name = str_replace(' ', '_', $request->title);
            $upload_date = date('d_m_Y_h_i_s');
            $sliderImage = $request->file('image_url');
            $fileType = $sliderImage->getClientOriginalExtension();
            $imageName = $file_name .'_'.$upload_date.'.' . $fileType;
            $directory = 'slider-images/';
            $imageUrl = $directory . $imageName;
            $sliderImage->move($directory, $imageName);
            $slider_data['image_url'] = $imageUrl;
        }else{
            unset($slider_data['image_url']);
        }

        $slider_image = SliderImage::findOrFail($id);
        $slider_image->update($slider_data);

        return redirect('slider_image');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = SliderImage::findOrFail($id);
        $slider->delete();
        return json_encode('success');
    }
}
