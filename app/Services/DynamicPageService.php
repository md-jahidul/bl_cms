<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\DynamicPageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class DynamicPageService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $pageRepo;

    /**
     * DynamicPageService constructor.
     * @param DynamicPageRepository $pageRepo
     */
    public function __construct(DynamicPageRepository $pageRepo) {
        $this->pageRepo = $pageRepo;
        $this->setActionRepository($pageRepo);
    }

    public function getList() {
        return $this->pageRepo->getAll();
    }

    public function getPage($id) {
        return $this->pageRepo->findOrFail($id);
    }

    public function savePage($request) {
        try {

            $request->validate([
                'page_name_en' => 'required',
                'page_name_bn' => 'required',
                'url_slug' => 'required|regex:/^\S*$/u',
                'page_content_en' => 'required',
                'page_content_bn' => 'required',
            ]);


            $data['page_id'] = $request->page_id;
            $data['page_name_en'] = $request->page_name_en;
            $data['page_name_bn'] = $request->page_name_bn;
            $data['url_slug'] = $request->url_slug;
            $data['page_content_en'] = $request->page_content_en;
            $data['page_content_bn'] = $request->page_content_bn;

            $this->pageRepo->savePage($data);
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

    public function deletePage($id) {
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
