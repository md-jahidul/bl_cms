<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 22/06/2020
 */

namespace App\Services;

use App\Helpers\BaseURLLocalization;
use App\Repositories\EthicsRepository;
use App\Repositories\EthicsFilesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class EthicsService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $pageRepo
     * @var $fileRepo
     */
    protected $pageRepo;
    protected $fileRepo;

    /**
     * EthicsService constructor.
     * @param EthicsRepository $pageRepo
     */
    public function __construct(
    EthicsRepository $pageRepo, EthicsFilesRepository $fileRepo
    ) {
        $this->pageRepo = $pageRepo;
        $this->fileRepo = $fileRepo;
    }

    /**
     * Get ethics page info
     * @return Response
     */
    public function getPageInfo() {
        $response = $this->pageRepo->getPageInfo();
        return $response;
    }

    /**
     * update ethics page info
     * @return array
     */
    public function updatePageInfo($request) {
        try {

            $request->validate([
                'page_name_en' => 'required',
                'page_name_bn' => 'required',
            ]);

            //file upload in storege

            $fileDir = 'assetlite/images/ethics';

            $webPath = $request['old_web'];
            if ($request['banner_web'] != "") {
                $webPath = $this->upload($request['banner_web'], $fileDir);

                //delete old web photo
                if ($request['old_web']) {
                    $this->deleteFile($request['old_web']);
                }
            }
            $mobilePath = $request['old_mobile'];
            if ($request['banner_mobile'] != "") {
                $mobilePath = $this->upload($request['banner_mobile'], $fileDir);

                //delete old mobile photo
                if ($request['old_mobile']) {
                    $this->deleteFile($request['old_mobile']);
                }
            }

            //save data in database
            $ethicsData = $this->pageRepo->updatePageInfo($webPath, $mobilePath, $request);

            $this->_saveSearchData($ethicsData);
            return [
                'success' => 1,
                'message' => "Page info updated"
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Get ethics files
     * @return Response
     */
    public function getFiles() {
        $response = $this->fileRepo->getFiles();
        return $response;
    }

    /**
     * update ethics page info
     * @return array
     */
    public function saveFile($request) {
        try {

            //file upload in storege
            $fileDir = 'assetlite/images/ethics/files';
            $imageDir = 'assetlite/images/ethics/images';

            $filePath = $request['old_path'];
            if ($request['file_path'] != "") {
                $filePath = $this->upload($request['file_path'], $fileDir);

                //delete old web photo
                if ($request['old_path']) {
                    $this->deleteFile($request['old_path']);
                }
            }
            if ($request['image_url'] != "") {
                $imgPath = $this->upload($request['image_url'], $imageDir);

                //delete old web photo
                if ($request['old_path_image_url']) {
                    $this->deleteFile($request['old_path_image_url']);
                }
            }
            if ($request['mobile_view_img'] != "") {
                $mobImgPath = $this->upload($request['mobile_view_img'], $imageDir);

                //delete old web photo
                if ($request['old_path_mobile_view_img']) {
                    $this->deleteFile($request['old_path_mobile_view_img']);
                }
            }

            //save data in database
            $fileData = $this->fileRepo->saveFileData($filePath,$imgPath,$mobImgPath, $request);

            $this->_saveSearchData($fileData, 'file_info');

            return [
                'success' => 1,
                'message' => "Page info updated"
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    private function _saveSearchData($product, $reqType = null)
    {
        $feature = BaseURLLocalization::featureBaseUrl();
        // URL make
        $urlEn = $feature['ethics-compliance_en'];
        $urlBn = $feature['ethics-compliance_bn'];

        $saveSearchData = [
            'product_code' => null,
            'type' => 'ethics-compliance',
            'page_title_en' => $reqType == "file_info" ? $product['file_name_en'] : $product['page_name_en'],
            'page_title_bn' => $reqType == "file_info" ? $product['file_name_bn'] : $product['page_name_bn'],
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => $product['status'] ?? 1,
        ];

        if ($product->searchableFeature()->first()) {
            $product->searchableFeature()->update($saveSearchData);
        } else {
            $product->searchableFeature()->create($saveSearchData);
        }
    }

    /**
     * Change file sorting
     * @return Response
     */
    public function changeFileSort($request) {
        $response = $this->fileRepo->changeFileSorting($request);
        return $response;
    }

    /**
     * Change file sorting
     * @return Response
     */
    public function changeFileStatus($fileId) {
        $response = $this->fileRepo->changeFileStatus($fileId);
        return $response;
    }

    /**
     * Change file sorting
     * @return Response
     */
    public function getFileData($fileId) {
        $response = $this->fileRepo->getFileData($fileId);
        return $response;
    }

    /**
     * Delete file
     * @return Response
     */
    public function deleteEthicsFile($fileId) {
        try {
            $file = $this->fileRepo->getFileData($fileId);
            $filePath = $file->file_path;

            $this->fileRepo->deleteFile($fileId);

            if ($filePath != "") {

                $this->deleteFile($filePath);
            }

            $response = [
                'success' => 1
            ];
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e
            ];
            return $response;
        }
    }

}
