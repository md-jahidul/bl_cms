<?php

namespace App\Services\Page;

use App\Repositories\Page\PageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;

class PageService
{
    use CrudTrait;
    use FileTrait;
    private $pageRepository;

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
        if (!$page) {
            $data['slug'] = str_replace(' ', '_', strtolower($data['name']));
            $this->save($data);
            return response('Page Save Successfully!!');
        }else{
            $page->update($data);
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
    }
}
