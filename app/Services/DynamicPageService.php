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
            $pageInfo = $this->findOne($data['page_id']);
            $dirPath = 'assetlite/images/banner/dynamic_page';

            if (!empty($data['banner_image_url'])) {
                $photoName = $data['banner_name'] . '-web';
                $data['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath, $photoName);
                $filePath = isset($pageInfo->banner_image_url) ? $pageInfo->banner_image_url : null;
                $this->deleteFile($filePath);
            }

            if (!empty($data['banner_mobile_view'])) {
                $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath, $photoName);
                $filePath = isset($pageInfo->banner_mobile_view) ? $pageInfo->banner_mobile_view : null;
                $this->deleteFile($filePath);
            }
            $data['url_slug'] = str_replace(str_split('\/:*?" _<>|'), '-', strtolower($data['url_slug']));

            if ($pageInfo) {
                $data['updated_by'] = Auth::id();
                $pageInfo->update($data);
            } else {
                $data['created_by'] = Auth::id();
                $this->save($data);
            }

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
