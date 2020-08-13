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
use App\Repositories\FourGCampaignRepository;
use App\Services\Assetlite\ComponentService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FourGCampaignService
{
    use CrudTrait;
    use FileTrait;

    private $fourGCampaignRepository;

    /**
     * DynamicPageService constructor.
     * @param FourGCampaignRepository $fourGCampaignRepository
     */
    public function __construct(FourGCampaignRepository $fourGCampaignRepository)
    {
        $this->fourGCampaignRepository = $fourGCampaignRepository;
        $this->setActionRepository($fourGCampaignRepository);
    }

//    public function getList()
//    {
//        return $this->$fourGCampaignRepository->getAll();
//    }

//    public function getPage($id)
//    {
//        return $this->pageRepo->findOrFail($id);
//    }

    public function storeCampaign($data)
    {
        try {
            if (!empty($data['image_url'])) {
                $directoryPath = "assetlite/images/four-g-campaign";
                $data['image_url'] = $this->upload($data['image_url'], $directoryPath);
            }
            $data['created_by'] = Auth::id();
            $this->save($data);
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

    public function updateCampaign($data)
    {
        try {
            $campaign = $this->findOne($data['id']);
            if (!empty($data['image_url'])) {
                $directoryPath = "assetlite/images/four-g-campaign";
                $data['image_url'] = $this->upload($data['image_url'], $directoryPath);
            }
            $data['updated_by'] = Auth::id();
            $campaign->update($data);
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

    public function deleteCampaign($id)
    {
        try {
            $campaign = $this->fourGCampaignRepository->findOrFail($id);
            $this->deleteFile($campaign->image_url);
            $campaign->delete();
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
