<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\OfferCategoryRepository;
use App\Repositories\SearchDataRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OfferCategoryService
{

    use CrudTrait;
    use FileTrait;

    /**
     * @var $offerCategoryRepository
     * @var $searchRepository
     */
    protected $offerCategoryRepository;
    protected $searchRepository;

    /**
     * OfferCategoryService constructor.
     * @param OfferCategoryRepository $offerCategoryRepository
     */
    public function __construct(OfferCategoryRepository $offerCategoryRepository, SearchDataRepository $searchRepository)
    {
        $this->offerCategoryRepository = $offerCategoryRepository;
        $this->searchRepository = $searchRepository;
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
     * @return array
     */
    public function updateOfferCategory($data, $id)
    {
        try {
//<<<<<<< HEAD
//            $status = true;
//            $update = [];
//
//            $update['name_en'] = $data['name_en'];
//            $update['name_bn'] = $data['name_bn'];
//            $update['url_slug'] = $data['url_slug'];
//            $update['url_slug_bn'] = $data['url_slug_bn'];
//            $update['schema_markup'] = $data['schema_markup'];
//            $update['page_header'] = $data['page_header'];
//            $update['page_header_bn'] = $data['page_header_bn'];
//            $update['banner_name'] = $data['banner_name'];
//            $update['banner_name_bn'] = $data['banner_name_bn'];
//            $update['banner_alt_text'] = $data['banner_alt_text'];
//            $update['banner_alt_text_bn'] = $data['banner_alt_text_bn'];
//            $update['updated_by'] = Auth::id();
//=======
//>>>>>>> seo_cms
            $offerCategory = $this->findOne($id);
            $data['updated_by'] = Auth::id();

            $dirPath = 'assetlite/images/banner/offer_image';

            // Prepaid
            if (isset($data['banner_image_url'])) {
                $data['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath);
                $this->deleteFile($offerCategory->banner_image_url);
            }

            if (!empty($data['banner_image_mobile'])) {
                $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], $dirPath);
                $this->deleteFile($offerCategory->banner_image_mobile);
            }

            // Postpaid
            if (!empty($data['postpaid_banner_image_url'])) {
                $data['postpaid_banner_image_url'] = $this->upload($data['postpaid_banner_image_url'], $dirPath);
                $this->deleteFile($offerCategory->postpaid_banner_image_url);
            }

            if (!empty($data['postpaid_banner_image_mobile'])) {
                $data['postpaid_banner_image_mobile'] = $this->upload($data['postpaid_banner_image_mobile'], $dirPath);
                $this->deleteFile($offerCategory->postpaid_banner_image_mobile);
            }

            if ($offerCategory) {
                $offerCategory->update($data);
                $this->_updateSearchCategorySlug($id);
                $response = ['success' => 1];
            } else {
                $response = ['success' => 2];
            }
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    private function _updateSearchCategorySlug($catId)
    {
        $category = $this->findOrFail($catId);
        $keywordType = "offer-" . $category->alias;
        $this->searchRepository->updateByCategory($keywordType, $category->url_slug);
    }

    public function getRelatedProducts()
    {
        return $this->offerCategoryRepository->findOneByProperties(['alias' => 'packages']);
    }

    /**
     * @param $data
     * @return ResponseFactory|Response
     */
    public function storeRelatedProduct($data)
    {
        $offerType = $this->offerCategoryRepository->findOneByProperties(['alias' => 'packages']);
        // get original data
        $new_multiple_attributes = $offerType->other_attributes;

        // contains all the inputs from the form as an array
        $input_other_attributes = isset($data['other_attributes']) ?
            $data['other_attributes'] : [$data['type'] . "_related_product_id" => []];

        // loop over the product array
        if ($input_other_attributes) {
            foreach ($input_other_attributes as $data_id => $inputData) {
                $new_multiple_attributes[$data_id] = $inputData;
            }
        }
        $data['other_attributes'] = $new_multiple_attributes;
        $offerType->update($data);

        return response('Related product save successfully');
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
