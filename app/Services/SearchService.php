<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/03/2020
 */

namespace App\Services;

use App\Repositories\FrontEndDynamicRoutesRepository;
use App\Repositories\SearchableDataRepository;
use App\Repositories\SearchSettingRepository;
use App\Repositories\PopularSearchRepository;
use App\Repositories\TagCategoryRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class SearchService
{

    use CrudTrait;

    /**
     * @var $settingRepo
     * @var $popularRepo
     * @var $tagsRepo
     * @var $dataRepo
     */
    protected $settingRepo;
    protected $popularRepo;
    protected $tagsRepo;
    protected $dataRepo;
    protected $productRepo;
    /**
     * @var FrontEndDynamicRoutesRepository
     */
    private $dynamicRoutesRepository;

    /**
     * SearchService constructor.
     * @param SearchSettingRepository $settingRepo
     * @param PopularSearchRepository $popularRepo
     * @param TagCategoryRepository $tagsRepo
     * @param SearchDataRepository $dataRepo
     * @param ProductRepository $productRepo
     */
    public function __construct(
        SearchableDataRepository $searchableDataRepository
    ) {
        $this->setActionRepository($searchableDataRepository);
    }

    public function storeSearchPage($data)
    {
        $data['featureable_id'] = 0;
        $data['featureable_type'] = "App\Models\SearchableData";
        $data['type'] = "single-search-page";
        $this->save($data);
        return Response('Single search page add successfully!!');
    }


    public function updateSearchPage($data, $id)
    {
        $page = $this->findOne($id);
        $data['featureable_id'] = 0;
        $data['featureable_type'] = "App\Models\SearchableData";
        $data['type'] = "single-search-page";
        $page->update($data);
        return Response('Single search page update successfully!!');
    }

    public function deleteSingleSearchPage($id)
    {
        $page = $this->findOne($id);
        $page->delete();
        return Response('Page deleted from search successfully !');
    }

//    /**
//     * Get search setting data
//     * @return Response
//     */
//    public function getSettingData()
//    {
//        $response = $this->settingRepo->getSettingData();
//        return $response;
//    }

//    /**
//     * Get popular search  data
//     * @return Response
//     */
//    public function getPopularSearch()
//    {
//        $response = $this->popularRepo->getPopularData();
//        return $response;
//    }

//    /**
//     * Change category name
//     * @return Response
//     */
//    public function updateSearchLimit($request)
//    {
//        $settingId = $request->settingId;
//        $limit = $request->limit;
//        return $this->settingRepo->saveLimit($settingId, $limit);
//    }

//    /**
//     * Get tags
//     * @return Response
//     */
//    public function getTags()
//    {
//        $response = $this->tagsRepo->getTags();
//        return $response;
//    }

//    /**
//     * Get Products
//     * @return Response
//     */
//    public function getProducts($request)
//    {
//        $type = $request->type;
//        $response = $this->productRepo->getProductsForSearch($type);
//
//        $options = "";
//        foreach ($response as $val) {
//            $options .= "<option value='$val->id'>$val->name_en</option>";
//        }
//        return $options;
//    }

//    /**
//     * Get Products
//     * @return Response
//     */
//    public function popularSearchById($kwId)
//    {
//        $response = $this->popularRepo->getKeywordById($kwId);
//        return $response;
//    }

//    public function saveSearchData($productId, $name, $url, $type, $tag)
//    {
//        return $this->dataRepo->saveData($productId, $name, $url, $type, $tag);
//    }

//    public function prepareSearchData($request)
//    {
//        //save data in database
//        $productId = $request->product;
//        $type = $request->type;
//
//        $product = $this->productRepo->findOrFail($productId);
//
//        $categoryUrlEn = $product->offer_category->url_slug;
//        $categoryUrlBn = $product->offer_category->url_slug_bn;
//
//        $prepaidOfferTypes = ['prepaid-internet', 'prepaid-voice', 'prepaid-bundle'];
//        $postpaidOfferTypes = ['postpaid-internet'];
//
//        $simTypeEn = null;
//        $simTypeBn = null;
//        if (in_array($type, $prepaidOfferTypes)) {
//            $findSIMType = $this->dynamicRoutesRepository->findByProperties(['key' => 'prepaid']);
//            foreach ($findSIMType as $data) {
//                if ($data->lang_type == 'en') {
//                    $simTypeEn = str_replace('/en/', '', $data->url);
//                } elseif ($data->lang_type == 'bn') {
//                    $simTypeBn = str_replace('/bn/', '', $data->url);
//                }
//            }
//        } elseif (in_array($type, $postpaidOfferTypes)) {
//            $findSIMType = $this->dynamicRoutesRepository->findByProperties(['key' => 'postpaid']);
//            foreach ($findSIMType as $data) {
//                if ($data->lang_type == 'en') {
//                    $simTypeEn = str_replace('/en/', '', $data->url);
//                } elseif ($data->lang_type == 'bn') {
//                    $simTypeBn = str_replace('/bn/', '', $data->url);
//                }
//            }
//        } else {
//            return [
//                'success' => 0,
//                'message' => "Offer Types Not Found"
//            ];
//        }
//
//        $searchKeywordData = [
//            'keyword' => $request->keyword,
//            'keyword_bn' => $request->keyword_bn,
//            'url' => "$simTypeEn/$categoryUrlEn/$product->url_slug",
//            'url_bn' => "$simTypeBn/$categoryUrlBn/$product->url_slug_bn",
//            'type' => $request->type,
//            'product_id' => $productId,
//        ];
//        if (!isset($request->search_keyword_id)) {
//            $totalPopularSearch = $this->findAll()->count();
//            $searchKeywordData['sort'] = $totalPopularSearch + 1;
//        }
//        return $searchKeywordData;
//    }

//    public function savePopularSearch($request)
//    {
//        try {
//            $request->validate([
//                'keyword' => 'required',

//                'keyword_bn' => 'required',
//                'type' => 'required',
//                'product' => 'required',
//            ]);
//
////            $urlArray = array(
////                'prepaid-internet' => "prepaid/$categoryUrl/$product->url_slug/$productId",
////                'prepaid-voice' => "prepaid/$categoryUrl/$product->url_slug/$productId",
////                'prepaid-bundle' => "prepaid/$categoryUrl/$product->url_slug/$productId",
////                'postpaid-internet' => "postpaid/$categoryUrl/$product->url_slug/$productId",
////            );
////            $url = $urlArray[$type];
////            $this->popularRepo->saveKeyword($productId, $keyword, $url);
//
//            $popularSearchData = $this->prepareSearchData($request);
//            $this->save($popularSearchData);
//
//            return [
//                'success' => 1,
//                'message' => "Keywored is saved!"
//            ];
//        } catch (\Exception $e) {
//            return [
//                'success' => 0,
//                'message' => $e->getMessage()
//            ];
//        }
//    }


//    public function updatePopularSearch($request)
//    {
//        try {
//            $request->validate([
//                'keyword' => 'required',
//                'keyword_bn' => 'required',
//                'type' => 'required',
//                'product' => 'required',
//            ]);
//
//            //save data in database
//            $searchKeyword = $this->popularRepo->findOne($request->search_keyword_id);
//
//            $popularSearchData = $this->prepareSearchData($request);
//            $searchKeyword->update($popularSearchData);
//
//            return [
//                'success' => 1,
//            ];
//        } catch (\Exception $e) {
//            return [
//                'success' => 0,
//            ];
//        }
//    }

//    public function changeKeywordSort($request)
//    {
//        $response = $this->popularRepo->changeKeywordSorting($request);
//        return $response;
//    }

//    public function deletePopularSearch($kwId)
//    {
//        try {
//            $this->popularRepo->deleteKeyword($kwId);
//            $response = [
//                'success' => 1,
//                'message' => "Keywored is deleted!"
//            ];
//
//            return $response;
//        } catch (\Exception $e) {
//            $response = [
//                'success' => 0,
//                'message' => $e->getMessage()
//            ];
//            return $response;
//        }
//    }

//    /**
//     * Change category home show status
//     * @return Response
//     */
//    public function popularSearchStatusChange($kwId)
//    {
//        $response = $this->popularRepo->changeStatus($kwId);
//        return $response;
//    }

//    public function offerWiseProducts($type)
//    {
//        return $this->productRepo->getProductsForSearch($type);
//    }

}
