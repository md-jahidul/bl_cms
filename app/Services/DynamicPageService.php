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
            unset($data['_token']);
            $data['url_slug'] = str_replace(str_split('\/:*?" _<>|'), '-', strtolower($data['url_slug']));

            if (isset($data['page_id'])) {
                $page = $this->pageRepo->findOrFail($data['page_id']);
                $page->update($data);
                $this->_saveSearchData($page, 'update');
            } else {
                $page = $this->save($data);
                $this->_saveSearchData($page, 'create');
            }

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

    private function _saveSearchData($page, $requestType)
    {
        $titleEn = $page->page_name_en;
        $titleBn = $page->page_name_bn;

        #Search Table Status
        $status = 1;

        $urlEn = $page->url_slug;
        $urlBn = $page->url_slug_bn;

        $saveSearchData = [
            'product_code' => null,
            'type' => 'dynamic-page',
            'page_title_en' => $titleEn,
            'page_title_bn' => $titleBn,
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => $status,
        ];

        if (!$page->searchableFeature()->first() || $requestType == "create") {
            $page->searchableFeature()->create($saveSearchData);
        }else {
            $page->searchableFeature()->update($saveSearchData);
        }
    }

    public function getComponents($pageId)
    {
        return $this->componentRepository->list($pageId, self::PageType);
    }

    public function deletePage($id)
    {
        try {
            $page = $this->pageRepo->findOrFail($id);
            $page->delete();
            $page->searchableFeature()->delete();
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
