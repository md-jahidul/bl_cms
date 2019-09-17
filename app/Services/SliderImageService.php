<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 12:37 PM
 */

namespace App\Services;


use App\Repositories\SliderImageRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class SliderImageService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $sliderImageRepository;

    /**
     * SliderImageService constructor.
     * @param SliderImageRepository $sliderImageRepository
     */
    public function __construct(SliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeSliderImage($data)
    {

        $count = count($this->sliderImageRepository->findAll());
        $imageUrl = $this->imageUpload($data, $data['title'], 'quick-launch-items');
        $data['image_url'] = $imageUrl;
        $data['sequence'] = ++$count;
        $this->save($data);
        return new Response('Slider Image added successfully');

//        $slider_data = $request->all();
//        $file_name = str_replace(' ', '_', $request->title);
//        $upload_date = date('d_m_Y_h_i_s');
//
//        $sliderImage = $request->file('image_url');
//        $fileType = $sliderImage->getClientOriginalExtension();
//        $imageName = $file_name .'_'.$upload_date.'.' . $fileType;
//        $directory = 'slider-images/';
//        $imageUrl = $imageName;
//        $sliderImage->move($directory, $imageName);
//
//        $slider_data['image_url'] = $imageUrl;
//        SliderImage::create($slider_data);

//        return new Response('Slider Image added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateSliderImage($data, $id)
    {
        return Response('Slider Image update successfully !');
    }

    public function deleteSliderImage()
    {
        return Response('Slider Image delete successfully');
    }


}
