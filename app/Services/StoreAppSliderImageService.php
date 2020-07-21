<?php

namespace App\Services;

use App\Models\MyBlProduct;
use App\Repositories\StoreAppSliderImageRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\SliderImageRepository;

class StoreAppSliderImageService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $sliderImageRepository;


    /**
     * StoreAppSliderImageService constructor.
     * @param StoreAppSliderImageRepository $sliderImageRepository
     */
    public function __construct(StoreAppSliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }


    /**
     * @param $sliderId
     * @param $type
     * @return mixed
     */
    public function itemList($sliderId, $type)
    {
        return $this->sliderImageRepository->getSliderImage($sliderId, $type);
    }


    /**
     * Storing the banner resource
     * @param $image
     * @return Response
     */
    public function storeSliderImage($image)
    {
        $image_data = $this->sliderImageRepository->sliderImage($image['store_app_id']);
        if (empty($image_data)) {
            $i = 1;
        } else {
            $i = $image_data->sequence + 1;
        }

        $image['image_url'] = 'storage/' . $image['image_url']->store('Slider_image');
        $image['sequence'] = $i;

        if (isset($image['other_attributes'])) {
            $other_attributes = [
                'type' => strtolower($image['redirect_url']),
                'content' => $image['other_attributes']
            ];

            $image['other_attributes'] = $other_attributes;
        }

        $this->save($image);

        return new Response("Image has been successfully added");
    }


    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->sliderImageRepository->sliderImageTableSort($data);
        return new Response('Sequence has been successfully update');
    }

    /**
     * Updating the banner
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateSliderImage($data, $id)
    {
        $sliderImage = $this->findOne($id);

        if (!isset($data['image_url'])) {
            $data['image_url'] = $sliderImage->image_url;
        } else {
            try {
                unlink($sliderImage->image_url);
            } catch (\Exception $e) {
                Log::error('Slider Image not found' . $e->getMessage());
            }
            $data['image_url'] = 'storage/' . $data['image_url']->store('Slider_image');
        }


        if (isset($data['other_attributes'])) {
            $other_attributes = [
                'type' => strtolower($data['redirect_url']),
                'content' => $data['other_attributes']
            ];

            $data['other_attributes'] = $other_attributes;
        }

        $sliderImage->update($data);
        return new Response("Image has has been successfully updated");
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
        return Response('Image has been successfully deleted');
    }
}
