<?php

namespace App\Services;

use App\Repositories\AlSliderImageRepository;
use App\Repositories\SliderImageRepository;
use App\Repositories\SliderRepository;
use App\Models\BusinessOthers;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AlSliderImageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $alSliderImageRepository;

    /**
     * AlSliderImageService constructor.
     * @param SliderImageRepository $alSliderImageRepository
     */
    public function __construct(AlSliderImageRepository $alSliderImageRepository)
    {
        $this->alSliderImageRepository = $alSliderImageRepository;
        $this->setActionRepository($alSliderImageRepository);
    }


    public function itemList($sliderId, $type)
    {
        return $this->alSliderImageRepository->getSliderImage($sliderId, $type);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeSliderImage($data, $sliderId)
    {
        $count = count($this->alSliderImageRepository->findAll());
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/slider-images');
        }

        if (request()->hasFile('mobile_view_img')) {
            $data['mobile_view_img'] = $this->upload($data['mobile_view_img'], 'assetlite/images/slider-images');
        }

        if (request()->hasFile('icon_image')) {
            $data['icon_image'] = $this->upload($data['icon_image'], 'assetlite/images/slider-images');
        }
        $data['slider_id'] = $sliderId;
        $data['display_order'] = ++$count;
        $image = $this->save($data);
        $imgId = $image->id;
        $this->saveInBusiness($data, $imgId);
        return new Response('Slider Image added successfully');
    }

    public function saveInBusiness($data, $imgId){
        $bsOthers = new BusinessOthers();
        $bsOthers->name = $data['title_en'];
        $bsOthers->name_bn = $data['title_bn'];
        $bsOthers->type = $imgId;
        $bsOthers->status = 1;
        $bsOthers->save();
    }

    public function tableSortable($data)
    {
        $this->alSliderImageRepository->sliderImageTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateSliderImage($data, $id)
    {
        $sliderImage = $this->findOne($id);
        if (request()->hasFile('image_url')) {
            $imageUrl = $this->upload($data['image_url'], 'assetlite/images/slider-images');
            $data['image_url'] = $imageUrl;
            $this->deleteFile($sliderImage['image_url']);
        }
        if (request()->hasFile('mobile_view_img')) {
            $imageUrl = $this->upload($data['mobile_view_img'], 'assetlite/images/slider-images');
            $data['mobile_view_img'] = $imageUrl;
            $this->deleteFile($sliderImage['mobile_view_img']);
        }
        if (request()->hasFile('icon_image')) {
            $imageUrl = $this->upload($data['icon_image'], 'assetlite/images/slider-images');
            $data['icon_image'] = $imageUrl;
            $this->deleteFile($sliderImage['icon_image']);
        }
        $sliderImage->update($data);
        return Response('Slider Image update successfully !');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $this->deleteFile($sliderImage['image_url']);
        $sliderImage->delete();
        return Response('Slider Image delete successfully');
    }
}
