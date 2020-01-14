<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\OfferCategoryRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class OfferCategoryService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $offerCategoryRepository
     */
    protected $offerCategoryRepository;

    /**
     * OfferCategoryService constructor.
     * @param OfferCategoryRepository $offerCategoryRepository
     */
    public function __construct(OfferCategoryRepository $offerCategoryRepository)
    {
        $this->offerCategoryRepository = $offerCategoryRepository;
        $this->setActionRepository($offerCategoryRepository);
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getOfferCategories($type)
    {
        return $this->offerCategoryRepository->getList($type);
    }

    public function packageChild()
    {
        return $this->offerCategoryRepository->child();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeOfferCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        $this->save($data);
        return new Response('Offer category added successfully');
    }

    /**
     * Updating the OfferCategory
     * @param $data
     * @return Response
     */
    public function updateOfferCategory($data, $id)
    {

        $offerCategory = $this->findOne($id);
        
        if (!empty($data['banner_image_url'])) {
            // $imageUrl = $this->imageUpload($data, "banner_image_url", $data['name_en'], '/uploads/assetlite/images/banner/offer_image');
            // $data['banner_image_url'] = '/assetlite/images/banner/offer_image/' . $imageUrl;
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/offer_image');
        }

        if( !empty($data['alias']) ){
            $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        }
        
        $offerCategory->update($data);
        
        return Response('Offer category updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteOfferCategory($id)
    {
        $offerCategory = $this->findOne($id);
        $offerCategory->delete();
        return Response('Offer category deleted successfully !');
    }


}
