<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderImage;
use App\Services\SliderImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderImageController extends Controller
{
    /**
     * @var $sliderImageService
     */
    private $sliderImageService;

    /**
     * SliderImageController constructor.
     * @param SliderImageService $sliderImageService
     */
    public function __construct(SliderImageService $sliderImageService)
    {
        $this->sliderImageService = $sliderImageService;
    }

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
        $response = $this->sliderImageService->storeSliderImage($request->all());
        Session::flash('message', $response->getContent());
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
    public function edit($parentId, $type, $id)
    {
        $sliderImage = SliderImage::findOrFail($id);
        $other_attributes = json_decode($sliderImage->other_attributes, true);
        return view('admin.slider-image.edit', compact('sliderImage','type', 'other_attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parentId, $type, $id)
    {

        $slider_data = $request->all();
        $other_attributes = $request->only('monthly_rate', 'google_play_link', 'app_store_link');

        $slider_data['other_attributes'] = json_encode($other_attributes);


        if (!empty($request->image_url)){
            $file_name = strtolower(str_replace(' ', '_', $request->title));
            $upload_date = date('d_m_Y_h_i_s');
            $sliderImage = $request->file('image_url');
            $fileType = $sliderImage->getClientOriginalExtension();
            $imageName = $file_name .'_'.$upload_date.'.' . $fileType;
            $directory = 'slider-images/';
            $imageUrl = $imageName;
            $sliderImage->move($directory, $imageName);
            $slider_data['image_url'] = $imageUrl;
        }



        $slider_image = SliderImage::findOrFail($id);
        $slider_image->update($slider_data);
        return redirect("slider/$parentId/$type");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parentId, $type, $id)
    {
        $slider = SliderImage::findOrFail($id);
        $slider->delete();
        return url("slider/$parentId/$type");
    }
}
