<?php

namespace App\Services\Assetlite;

use App\Http\Resources\BannerResource;
use App\Repositories\BusinessTypeDatasRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Exception;

/**
 * Class BusinessTypeDatasService
 * @package App\Services
 */
class BusinessTypeDatasService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var BusinessTypeDatasRepository
     */
    protected $businessTypeDatasRepository;


    /**
     * BannerService constructor.
     * @param BusinessTypeDatasRepository $businessTypeDatasRepository
     */
    public function __construct(BusinessTypeDatasRepository $businessTypeDatasRepository)
    {
        $this->businessTypeDatasRepository = $businessTypeDatasRepository;
        $this->setActionRepository($businessTypeDatasRepository);
    }

        /**
     * Storing the slider resource
     * @return Response
     */
    public function storeBusinessTypeDatas($data,$id)
    {

        $count = count($this->businessTypeDatasRepository->findAll());
        if (request()->hasFile('image_url')) {
            $data['image_url'] = $this->upload($data['image_url'], 'assetlite/images/slider-images');
        }

        if (request()->hasFile('mobile_view_img')) {
            $data['mobile_view_img'] = $this->upload($data['mobile_view_img'], 'assetlite/images/slider-images');
        }
        $data['business_type_id'] = $id;
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('Business Types added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateBusinessTypeDatas($data, $id)
    {
        $businessTypeData = $this->findOne($id);
        if (request()->hasFile('image_url')) {
            $imageUrl = $this->upload($data['image_url'], 'assetlite/images/slider-images');
            $data['image_url'] = $imageUrl;
            $this->deleteFile($businessTypeData['image_url']);
        }
        if (request()->hasFile('mobile_view_img')) {
            $imageUrl = $this->upload($data['mobile_view_img'], 'assetlite/images/slider-images');
            $data['mobile_view_img'] = $imageUrl;
            $this->deleteFile($businessTypeData['mobile_view_img']);
        }
        $businessTypeData->update($data);
        return Response('Business Types Item updated successfully !');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($position)
    {
        $this->businessTypeDatasRepository->sortData($position);
        return new Response('update successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteBusinessTypeDatas($id)
    {
        $buinessType = $this->findOne($id);
        $buinessType->delete();
        return Response('Business Types deleted successfully !');
    }
}
