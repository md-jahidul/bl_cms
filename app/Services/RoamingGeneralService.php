<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Helpers\BaseURLLocalization;
use App\Repositories\RoamingCategoryRepository;
use App\Repositories\RoamingPagesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoamingGeneralService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $catRepo
     * @var $pagesRepo
     */
    protected $catRepo;
    protected $pagesRepo;

    /**
     * RoamingGeneralService constructor.
     * @param RoamingCategoryRepository $catRepo
     * @param RoamingPagesRepository $pagesRepo
     */
    public function __construct(
        RoamingCategoryRepository $catRepo, RoamingPagesRepository $pagesRepo
    ) {
        $this->catRepo = $catRepo;
        $this->pagesRepo = $pagesRepo;
    }

    /**
     * Get Roaming categories
     * @return Response
     */
    public function getCategories() {
        $response = $this->catRepo->getCategoryList();
        return $response;
    }

    /**
     * Get single category data by Id
     * @return Response
     */
    public function getCategoryById($catId) {
        $response = $this->catRepo->getCategory($catId);
        return $response;
    }

    /**
     * update roaming category
     * @return array
     */
    public function updateCategory($request) {
        try {
            //file upload in storege
            $webPath = $request['old_web'];
            if ($request['banner_web'] != "") {
                $webPath = $this->upload($request['banner_web'], 'assetlite/images/roaming');

                //delete old web photo
                if ($request['old_web']) {
                    $this->deleteFile($request['old_web']);
                }
            }
            $mobilePath = $request['old_mobile'];
            if ($request['banner_mobile'] != "") {
                $mobilePath = $this->upload($request['banner_mobile'], 'assetlite/images/roaming');

                //delete old mobile photo
                if ($request['old_mobile']) {
                    $this->deleteFile($request['old_mobile']);
                }
            }

            //save data in database
            $category = $this->catRepo->updateCategory($webPath, $mobilePath, $request);

            $slug = [
                'slug_en' => $category->page_url,
                'slug_bn' => $category->page_url_bn
            ];

            $this->_saveSearchData($category, $slug, "category");

            return [
                'success' => 1,
                'message' => "News Saved"
            ];
        } catch (\Exception $e) {
            dd($e->getMessage());
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }


    /**
     * Change category sorting
     * @return Response
     */
    public function changeCategorySort($request) {
        return $this->catRepo->changeCategorySorting($request);
    }


    /**
     * Get Roaming general pages
     * @return Response
     */
    public function getPages() {
        return $this->pagesRepo->getPageList();
    }
    /**
     * Get Roaming general page by ID
     * @return Response
     */
    public function getPageById($pageId) {
        return $this->pagesRepo->getPage($pageId);
    }
    /**
     * Get Roaming general page components
     * @return Response
     */
    public function getPageComponents($pageId) {
        return $this->pagesRepo->getPageComponents($pageId);
    }

    /**
     * Change category sorting
     * @return JsonResponse
     */
    public function changeComponentSort($request) {
        return $this->pagesRepo->changeComponentSorting($request);
    }
    /**
     * Change category sorting
     * @return int[]
     */
    public function deleteComponent($comId) {
        try {
            $this->pagesRepo->deleteComponent($comId);
            return [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * update roaming category
     * @return array
     */
    public function updatePage($request) {
        try {
            $request->validate([
                'title_en' => 'required',
                'title_bn' => 'required',
                'page_id' => 'required',
                'page_type' => 'required',
            ]);

            $searchSpecialKeyword = [
                'tag_en' => $request->tag_en,
                'tag_bn' => $request->tag_bn
            ];

            unset($request['tag_en']);
            unset($request['tag_bn']);

            //save data in database
            $aboutPage = $this->pagesRepo->updatePage($request);

            $slug = [
                'slug_en' => 'international-roaming',
                'slug_bn' => 'international-roaming'
            ];
            $this->_saveSearchData($aboutPage, $slug, 'page', $searchSpecialKeyword);
            return [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    private function _saveSearchData($product, $slug, $type, $searchSpecialKeyword = [])
    {
        $feature = BaseURLLocalization::featureBaseUrl();

        // URL make
        $urlEn = $feature['roaming_en'] . "/" . $slug['slug_en'];
        $urlBn = $feature['roaming_bn'] . "/" . $slug['slug_bn'];

        $saveSearchData = [
            'product_code' => null,
            'type' => ($type == "category") ? "roaming-category" : 'about-roaming',
            'page_title_en' => ($type == "category") ? $product->banner_title_en : $product->name_en,
            'page_title_bn' => ($type == "category") ? $product->banner_title_bn : $product->name_bn,
            'tag_en' => $searchSpecialKeyword['tag_en'] ?? null,
            'tag_bn' => $searchSpecialKeyword['tag_bn'] ?? null,
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => $product->status ?? 1,
        ];

        if ($product->searchableFeature()->first()) {
            $product->searchableFeature()->update($saveSearchData);
        } else {
            $product->searchableFeature()->create($saveSearchData);
        }
    }
}
