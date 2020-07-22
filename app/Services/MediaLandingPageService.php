<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\MediaLandingPageRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Repositories\MediaTvcVideoRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MediaLandingPageService
{
    use CrudTrait;
    use FileTrait;

    protected $mediaLandingPageRepository;

    protected $mediaTvcVideoRepository;

    protected $mediaPressNewsEventRepository;

    /**
     * DigitalServicesService constructor.
     * @param MediaLandingPageRepository $mediaLandingPageRepository
     * @param MediaTvcVideoRepository $mediaTvcVideoRepository
     * @param MediaPressNewsEventRepository $mediaPressNewsEventRepository
     */
    public function __construct(
        MediaLandingPageRepository $mediaLandingPageRepository,
        MediaTvcVideoRepository $mediaTvcVideoRepository,
        MediaPressNewsEventRepository $mediaPressNewsEventRepository
    ) {
        $this->mediaLandingPageRepository = $mediaLandingPageRepository;
        $this->mediaTvcVideoRepository = $mediaTvcVideoRepository;
        $this->mediaPressNewsEventRepository = $mediaPressNewsEventRepository;
        $this->setActionRepository($mediaLandingPageRepository);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @return Response
     */
    public function storeComponent($data)
    {
        $data['created_by'] = Auth::id();
        $this->save($data);
        return new Response("Component has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateComponent($data, $id)
    {
        $component = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        $data['items'] = isset($data['items']) ? $data['items'] : '';
        $component->update($data);
        return Response('Component has been successfully updated');
    }

    public function mediaItems($type)
    {
        if ($type == "press_slider") {
            $data = $this->mediaPressNewsEventRepository
                ->findByProperties(['type' => "press_release"], ['id','title_en']);
        } elseif ($type == "news_carousel_slider") {
            $data = $this->mediaPressNewsEventRepository
                ->findByProperties(['type' => "news_events"], ['id','title_en']);
        } else {
            $data = $this->mediaTvcVideoRepository->findAll();
        }

        return $data;
    }

    public function getBannerImage()
    {
        return $this->mediaLandingPageRepository
            ->findOneByProperties(['component_type' => 'banner_image'], ['id', 'component_type', 'items']);
    }

//    protected function fileUploader($data)
//    {
//        $dirPath = 'assetlite/images/banner/media';
//        if (isset($data['items']['banner_image_url'])) {
//            $data['items']['banner_image_url'] = $this->upload($data['items']['banner_image_url'], $dirPath);
//        }
//        if (isset($data['items']['banner_mobile_view'])) {
//            $data['items']['banner_mobile_view'] = $this->upload($data['items']['banner_mobile_view'], $dirPath);
//        }
//        return $data;
//    }

//    public function bannerUpdate($data)
//    {
//        $bannerImage = $this->getBannerImage();
//
//        if (!$bannerImage) {
//            $data = $this->fileUploader($data);
//            $this->save($data);
//        } else {
//            // Get original data
//            $existJson = $bannerImage->items;
//            $data = $this->fileUploader($data);
//
//            // Contains all the inputs from the form as an array
//            $inputs = isset($data['items']) ? $data['items'] : null;
//
//            // loop over the items array
//            if ($inputs) {
//                foreach ($inputs as $field_key => $inputValue) {
//                    $existJson[$field_key] = $inputValue;
//                }
//            }
//            $data['items'] = $existJson;
//            $bannerImage->update($data);
//        }
//
//        return Response('Banner Image has been successfully updated');
//    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $component->delete();
        return Response('Item has been successfully deleted');
    }
}
