<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingCategoryRepository;
use App\Repositories\RoamingPagesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
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
            $this->catRepo->updateCategory($webPath, $mobilePath, $request);

            return [
                'success' => 1,
                'message' => "News Saved"
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }


    /**
     * Change category sorting
     * @return Response
     */
    public function changeCategorySort($request) {
        $response = $this->catRepo->changeCategorySorting($request);
        return $response;
    }


    /**
     * Get Roaming general pages
     * @return Response
     */
    public function getPages() {
        $response = $this->pagesRepo->getPageList();
        return $response;
    }
    /**
     * Get Roaming general page by ID
     * @return Response
     */
    public function getPageById($pageId) {
        $response = $this->pagesRepo->getPage($pageId);
        return $response;
    }
    /**
     * Get Roaming general page components
     * @return Response
     */
    public function getPageComponents($pageId) {
        $response = $this->pagesRepo->getPageComponents($pageId);
        return $response;
    }

    /**
     * Change category sorting
     * @return Response
     */
    public function changeComponentSort($request) {
        $response = $this->pagesRepo->changeComponentSorting($request);
        return $response;
    }
    /**
     * Change category sorting
     * @return Response
     */
    public function deleteComponent($comId) {

        try {

            $response = $this->pagesRepo->deleteComponent($comId);

            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }


    /**
     * update roaming category
     * @return Response
     */
    public function updatePage($request) {
        try {

            $request->validate([
                'title_en' => 'required',
                'title_bn' => 'required',
                'page_id' => 'required',
                'page_type' => 'required',
            ]);


            //save data in database
            $update = $this->pagesRepo->updatePage($request);


            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

}
