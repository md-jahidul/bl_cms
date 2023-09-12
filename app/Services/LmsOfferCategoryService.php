<?php

namespace App\Services;

use App\Helpers\BaseURLLocalization;
use App\Repositories\AlSliderRepository;
use App\Repositories\LmsOfferCategoryRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class LmsOfferCategoryService
{
    use CrudTrait;

    /**
     * @var $alSliderRepository
     */
    protected $alSliderRepository;
    /**
     * @var LmsOfferCategoryRepository
     */
    private $lmsOfferCategoryRepository;

    /**
     * LmsOfferCategoryService constructor.
     * @param LmsOfferCategoryRepository $lmsOfferCategoryRepository
     */
    public function __construct(LmsOfferCategoryRepository $lmsOfferCategoryRepository)
    {
        $this->lmsOfferCategoryRepository = $lmsOfferCategoryRepository;
        $this->setActionRepository($lmsOfferCategoryRepository);
    }

    public function shortCodeSliders($shortCode)
    {
        return $this->alSliderRepository->findByProperties(['short_code' => $shortCode]);
    }

    /**
     * Storing the slider resource
     * @return Response
     */
    public function storeLmsOfferCat($data)
    {
        $cat = $this->save($data);
        $this->_saveSearchData($cat);
        return new Response('Lms offer category added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateLmsOfferCat($data, $id)
    {
        $cat = $this->findOne($id);
        $cat->update($data);
        $this->_saveSearchData($cat);
        return Response('Slider updated successfully !');
    }

    private function _saveSearchData($product)
    {
        $feature = BaseURLLocalization::featureBaseUrl();

        $titleEn = $product->name_en;
        $titleBn = $product->name_bn;
        $productCode = null;

        #Search Table Status
        $status = $product->status;

        $urlEn = "";
        $urlBn = "";

        $urlEn .= $feature['loyalty_discount_privilege_en'];
        $urlBn .= $feature['loyalty_discount_privilege_bn'];

        // Category url
        $urlEn .= "/" . $product->url_slug_en;
        $urlBn .= "/" . $product->url_slug_bn;

        $saveSearchData = [
            'product_code' => $productCode,
            'type' => 'loyalty-discount-privilege',
            'page_title_en' => $titleEn,
            'page_title_bn' => $titleBn,
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => 1,
        ];

        if (!$product->searchableFeature()->first()) {
            $product->searchableFeature()->create($saveSearchData);
        }else {
            $product->searchableFeature()->update($saveSearchData);
        }
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteLmsOfferCat($id)
    {
        $lmsOfferCat = $this->findOne($id);
//        dd($lmsOfferCat);
        $lmsOfferCat->delete();
        return Response('LMS offer category deleted successfully !');
    }
}
