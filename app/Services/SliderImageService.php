<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\SliderImageRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;


class SliderImageService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $sliderImageRepository;

    /**
     * DigitalServicesService constructor.
     * @param SliderImageRepository $sliderTypeRepository
     */
    public function __construct(SliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSliderImage($images)
    {
        $slider_id = $images[0]['slider_id'];
        $image_data = $this->sliderImageRepository->sliderImage($slider_id);
        if(empty($image_data)){
            $i = 1;
        }else{
            $i = $image_data->sequence+1;
        }
        foreach ($images as $image) {
            $image['image_url'] = 'storage/'.$image['image_url']->store('Slider_image');
            $image['sequence'] = $i; 
            $image['slider_id'] = $slider_id; 
            $this->save($image);
            $i++;
        }
        return new Response("Image has successfully been Added to slider");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSliderImage($data, $id)
    {
        $sliderImage = $this->findOne($id);
        if(!isset($data['image_url'])){
        $data['image_url'] = $sliderImage->image_url;
        }else{
            unlink($sliderImage->image_url);
            $data['image_url'] = 'storage/'.$data['image_url']->store('Slider_image');
        }
        $sliderImage->update($data);
        return new Response("Image has successfully been updated to slider");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $sliderImage->delete();
        return Response('Slider Image deleted successfully !');
    }

}
