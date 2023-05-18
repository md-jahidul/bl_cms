<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Helpers\BaseURLLocalization;
use App\Repositories\AlFaqRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MediaPressNewsEventService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $mediaPNERepository;

    /**
     * DigitalServicesService constructor.
     * @param MediaPressNewsEventRepository $mediaPNERepository
     */
    public function __construct(MediaPressNewsEventRepository $mediaPNERepository)
    {
        $this->mediaPNERepository = $mediaPNERepository;
        $this->setActionRepository($mediaPNERepository);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @return Response
     */
    public function storePNE($data, $referenceType = null)
    {
        // $originalDate = "2010-03-21";
        // $newDate = date("d-m-Y", strtotime($originalDate));
        // $from = "2020-05-21";
        // $to = "2020-07-30";

        $dirPath = 'assetlite/images/media';
        if (request()->hasFile('thumbnail_image')) {
            $data['thumbnail_image'] = $this->upload($data['thumbnail_image'], $dirPath);
        }
        if (request()->hasFile('details_image')) {
            $data['details_image'] = $this->upload($data['details_image'], $dirPath);
        }
        unset($data['file']);
        $data['created_by'] = Auth::id();
        $data['reference_type'] = $referenceType;
        $blog = $this->save($data);

        $this->_saveSearchData($blog);
        return new Response("Item has been successfully created");
    }

    private function _saveSearchData($product)
    {
        $feature = BaseURLLocalization::featureBaseUrl();

        // URL make
        $urlEn = $feature['blog_en'] . "/" . $product->url_slug_en;
        $urlBn = $feature['blog_bn'] . "/" . $product->url_slug_bn;

        $saveSearchData = [
            'product_code' => null,
            'type' => 'blog',
            'page_title_en' => $product->title_en,
            'page_title_bn' => $product->title_bn,
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

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updatePNE($data, $id)
    {
        $mediaPNE = $this->findOne($id);

        $dirPath = 'assetlite/images/media';
        if (request()->hasFile('thumbnail_image')) {
            $data['thumbnail_image'] = $this->upload($data['thumbnail_image'], $dirPath);
            $this->deleteFile($mediaPNE->thumbnail_image);
        }
        if (request()->hasFile('details_image')) {
            $data['details_image'] = $this->upload($data['details_image'], $dirPath);
        }

        unset($data['files']);
        $data['show_in_home'] = (isset($data['show_in_home'])) ? 1 : 0;
        $data['updated_by'] = Auth::id();
        $mediaPNE->update($data);

        $this->_saveSearchData($mediaPNE);
        return Response('Update successfully!');
    }

    public function findByReferenceType($referenceType)
    {
        $orderBy = ['column' => 'date', 'direction' => 'DESC'];
        return $this->mediaPNERepository->findBy(['reference_type' => $referenceType], '', $orderBy);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deletePNE($id)
    {
        $mediaPNE = $this->findOne($id);
        $this->deleteFile($mediaPNE->thumbnail_image);
        $mediaPNE->delete();

        $mediaPNE->searchableFeature()->delete();
        return Response('Item has been successfully deleted');
    }

    public function searchDataSync()
    {
        $products = $this->findAll();
        foreach ($products as $product){
            if ($product->status && $product->reference_type == "blog") {
                $this->_saveSearchData($product);
            }
        }
        return Response('Blog post search data sync successfully !');
    }
}
