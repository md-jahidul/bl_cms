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
    public function storeComponent($data, $referenceType = null)
    {
        $data['created_by'] = Auth::id();
        $data['reference_type'] = $referenceType;
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
        $data['items'] = $data['items'] ?? '';
        $data['slider_items'] = $data['slider_items'] ?? '';
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

    public function tableSortable($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->findOne($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }



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
