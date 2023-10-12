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
        $data['slug'] = str_replace(' ', '_', strtolower($data['name']));
        return $this->save($data);
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
