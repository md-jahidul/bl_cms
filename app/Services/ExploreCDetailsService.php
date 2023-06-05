<?php
namespace App\Services;

use App\Helpers\BaseURLLocalization;
use App\Repositories\ExploreCDetailsRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class ExploreCDetailsService
{
    use CrudTrait;

    protected $exploreCDetailsRepository;

    public function __construct( ExploreCDetailsRepository $exploreCDetailsRepository)
    {
        $this->exploreCDetailsRepository = $exploreCDetailsRepository;
        $this->setActionRepository($exploreCDetailsRepository);
    }

    public function getList($type)
    {
        // return $this->exploreCDetailsRepository->getAll();
        return $this->exploreCDetailsRepository->findByProperties(['type' => $type]);
    }

    public function getPage($id)
    {
        return $this->exploreCDetailsRepository->findOrFail($id);
    }

    public function savePage($data, $type)
    {
        try {
            $searchKeyword = [
                'tag_en' => $data['tag_en'],
                'tag_bn' => $data['tag_bn']
            ];

            $data['type'] = $type;
            $data['url_slug'] = str_replace(str_split('\/:*?" _<>|'), '-', strtolower($data['url_slug']));
            unset($data['_token']);
            unset($data['tag_en']);
            unset($data['tag_bn']);

            $explore = $this->exploreCDetailsRepository->savePage($data);

            $this->_saveSearchData($explore, $searchKeyword);

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

    private function _saveSearchData($product, $specialKeyWord)
    {
        $feature = BaseURLLocalization::featureBaseUrl();
        // URL make
        $urlEn = $feature['explore_c_en'] . '/' . $product->url_slug;
        $urlBn = $feature['explore_c_bn'] . '/' . $product->url_slug_bn;

        $saveSearchData = [
            'product_code' => null,
            'type' => 'explore-c',
            'page_title_en' => $product->page_name_en,
            'page_title_bn' => $product->page_name_bn,
            'tag_en' => $specialKeyWord['tag_en'],
            'tag_bn' => $specialKeyWord['tag_bn'],
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

    public function deletePage($id)
    {
        try {
            $page = $this->exploreCDetailsRepository->findOrFail($id);
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
