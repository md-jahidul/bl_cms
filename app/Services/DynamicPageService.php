<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\ComponentRepository;
use App\Repositories\DynamicPageRepository;
use App\Services\Assetlite\ComponentService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DynamicPageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $pageRepo;

    protected $componentRepository;

    protected const PageType = "other_dynamic_page";

    /**
     * DynamicPageService constructor.
     * @param DynamicPageRepository $pageRepo
     * @param ComponentRepository $componentRepository
     */
    public function __construct(DynamicPageRepository $pageRepo, ComponentRepository $componentRepository)
    {
        $this->pageRepo = $pageRepo;
        $this->componentRepository = $componentRepository;
        $this->setActionRepository($pageRepo);
    }

    public function getList()
    {
        return $this->pageRepo->getAll();
    }

    public function getPage($id)
    {
        return $this->pageRepo->findOrFail($id);
    }

    public function savePage($data)
    {
        try {
            // if (!empty($data['banner_image_url'])) {
            //     //delete old web photo
            //     if ($data['old_web_img'] != "") {
            //         $this->deleteFile($data['old_web_img']);
            //     }
            //     $photoName = $data['banner_name'] . '-web';
            //     $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/dynamic_page', $photoName);
            // }

            // if (!empty($data['banner_mobile_view'])) {
            //     //delete old web photo
            //     if ($data['old_mob_img'] != "") {
            //         $this->deleteFile($data['old_mob_img']);
            //     }
            //     $photoName = $data['banner_name'] . '-mobile';
            //     $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], 'assetlite/images/banner/dynamic_page', $photoName);
            // }

            //only rename
            // if ($data['old_banner_name'] != $data['banner_name']) {
            //     if (empty($data['banner_image_url']) && $data['old_web_img'] != "") {
            //         $fileName = $data['banner_name'] . '-web';
            //         $directoryPath = 'assetlite/images/banner/dynamic_page';
            //         $data['banner_image_url'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
            //     }
            //     if (empty($data['banner_mobile_view']) && $data['old_mob_img'] != "") {
            //         $fileName = $data['banner_name'] . '-mobile';
            //         $directoryPath = 'assetlite/images/banner/dynamic_page';
            //         $data['banner_mobile_view'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
            //     }
            // }
            // unset($data['old_web_img']);
            // unset($data['old_mob_img']);
            // unset($data['old_banner_name']);
            unset($data['_token']);
            $data['url_slug'] = str_replace(str_split('\/:*?" _<>|'), '-', strtolower($data['url_slug']));
            $this->pageRepo->savePage($data);
            $response = [
                'success' => 1,
                'message' => 'Page added successfully!'
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

    public function getComponents($pageId)
    {
        return $this->componentRepository->list($pageId, self::PageType);
    }

    public function deletePage($id)
    {
        try {
            $this->pageRepo->findOrFail($id)->delete();
            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }

}
