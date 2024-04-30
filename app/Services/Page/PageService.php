<?php

namespace App\Services\Page;

use App\Repositories\Page\PageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Redis;

class PageService
{
    use CrudTrait;
    use FileTrait;
    private $pageRepository;
    protected const REDIS_PAGE_KEY = "new_page_components:";

    /**
     * PageService constructor.
     * @param PageRepository $pageRepository
     */
    public function __construct(
        PageRepository $pageRepository
    ) {
        $this->pageRepository = $pageRepository;
        $this->setActionRepository($pageRepository);
    }

    public function findBySlug($slug)
    {
        return $this->pageRepository->findOneByProperties(['slug' => $slug]);
    }

    public function storePage($data)
    {
        $page = $this->findOne($data['page_id']);
        $data['url_slug'] = str_replace(' ', '-', strtolower($data['url_slug']));
        if (!$page) {
            $data['slug'] = str_replace(' ', '_', strtolower($data['name']));
            $this->save($data);
            return response('Page Save Successfully!!');
        }else{
            $page->update($data);
            $redisKey = self::REDIS_PAGE_KEY . $page->url_slug;
            Redis::del($redisKey);
            return Response('Page Update Successfully!!');
        }
    }
    public function updatePage($data, $id)
    {
        $page = $this->findOne($id);
        return $page->update($data);
    }

    public function destroy($id)
    {
        $page = $this->findOne($id);
        $page->delete();
        $redisKey = self::REDIS_PAGE_KEY . $page->url_slug;
        Redis::del($redisKey);
    }
}
